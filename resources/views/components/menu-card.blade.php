<button type="button" class="card"
    onclick="openMenuModal('{{ $item->menu_name }}', '{{ number_format($item->price, 0) }}')"
    style="
        cursor: pointer;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        margin: 5px;
        min-width: 220px;
        max-width: 220px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.2s;
    "
    onmouseover="this.style.transform='scale(1.02)'"
    onmouseout="this.style.transform='scale(1)'">

    <img src="{{ asset('storage/' . $item->image) }}"
         style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; pointer-events: none;">

    <div class="menu-info" style="margin-top: 10px; pointer-events: none;">
        <h5 style="margin: 0; font-size: 16px; color: #333; font-weight: bold;">
            {{ $item->menu_name }}
        </h5>
    </div>

    <div class="menu-price" style="margin-top: 5px; pointer-events: none;">
        <p style="color: #ff6600; font-weight: bold; margin: 0; font-size: 14px;">
            {{ number_format($item->price) }} บาท
        </p>
    </div>
</button>
