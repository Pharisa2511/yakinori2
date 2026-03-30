<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_order_items_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_order_items_after_update');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_order_items_after_delete');

        DB::unprepared(<<<'SQL'
            CREATE TRIGGER trg_order_items_after_insert
            AFTER INSERT ON order_items
            FOR EACH ROW
            BEGIN
                UPDATE orders
                SET total_price = (
                    SELECT COALESCE(SUM(price * quantity), 0)
                    FROM order_items
                    WHERE order_id = NEW.order_id
                )
                WHERE order_id = NEW.order_id;
            END
        SQL);

        DB::unprepared(<<<'SQL'
            CREATE TRIGGER trg_order_items_after_update
            AFTER UPDATE ON order_items
            FOR EACH ROW
            BEGIN
                UPDATE orders
                SET total_price = (
                    SELECT COALESCE(SUM(price * quantity), 0)
                    FROM order_items
                    WHERE order_id = NEW.order_id
                )
                WHERE order_id = NEW.order_id;

                IF OLD.order_id <> NEW.order_id THEN
                    UPDATE orders
                    SET total_price = (
                        SELECT COALESCE(SUM(price * quantity), 0)
                        FROM order_items
                        WHERE order_id = OLD.order_id
                    )
                    WHERE order_id = OLD.order_id;
                END IF;
            END
        SQL);

        DB::unprepared(<<<'SQL'
            CREATE TRIGGER trg_order_items_after_delete
            AFTER DELETE ON order_items
            FOR EACH ROW
            BEGIN
                UPDATE orders
                SET total_price = (
                    SELECT COALESCE(SUM(price * quantity), 0)
                    FROM order_items
                    WHERE order_id = OLD.order_id
                )
                WHERE order_id = OLD.order_id;
            END
        SQL);

        DB::statement(<<<'SQL'
            UPDATE orders
            SET total_price = (
                SELECT COALESCE(SUM(order_items.price * order_items.quantity), 0)
                FROM order_items
                WHERE order_items.order_id = orders.order_id
            )
        SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_order_items_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_order_items_after_update');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_order_items_after_delete');
    }
};
