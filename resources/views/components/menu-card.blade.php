{{-- resources/views/components/menu-card.blade.php (ไฟล์เดียวจบ) --}}
<div class="card" style="
    min-width: 180px;
    max-width: 180px;
    height: auto;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin: 5px; /* เพิ่มระยะห่างระหว่างการ์ด */
">
    <img src="{{ asset('storage/' . $item->image) }}"
         style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px;">

    <div class="menu-info" style="margin-top: 10px;">
        <h5 style="margin: 0; font-size: 16px; color: #333; font-weight: bold;">
            {{ $item->menu_name }}
        </h5>
    </div>

    <div class="menu-price" style="margin-top: 5px;">
        <p style="color: #ff6600; font-weight: bold; margin: 0; font-size: 14px;">
            {{ number_format($item->price) }} บาท
        </p>
    </div>
</div>
