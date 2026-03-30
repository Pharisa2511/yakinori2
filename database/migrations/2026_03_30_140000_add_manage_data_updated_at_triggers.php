<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([
            'categories' => 'category_id',
            'menus' => 'menu_id',
            'tables' => 'table_id',
            'menu_options' => 'option_id',
        ] as $table => $primaryKey) {
            $triggerName = "trg_{$table}_before_update_set_updated_at";

            DB::unprepared("DROP TRIGGER IF EXISTS {$triggerName}");

            DB::unprepared(<<<SQL
                CREATE TRIGGER {$triggerName}
                BEFORE UPDATE ON {$table}
                FOR EACH ROW
                BEGIN
                    SET NEW.updated_at = CURRENT_TIMESTAMP;
                END
            SQL);
        }
    }

    public function down(): void
    {
        foreach (['categories', 'menus', 'tables', 'menu_options'] as $table) {
            DB::unprepared("DROP TRIGGER IF EXISTS trg_{$table}_before_update_set_updated_at");
        }
    }
};
