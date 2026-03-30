<button type="button"
    onclick="openMenuModal(
        '{{ $item->menu_id }}',
        '{{ addslashes($item->menu_name) }}',
        '{{ $item->price }}',
        '{{ route('menu.image', ['menu_id' => $item->menu_id]) }}',
        '{{ addslashes(json_encode($item->options)) }}'
    )"
    class="card h-100 border-0 rounded-4 overflow-hidden text-start shadow-sm"
    style="background: rgba(255, 251, 245, 0.94); cursor: pointer; transition: transform 0.2s ease, box-shadow 0.2s ease;"
    onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 1rem 2.2rem rgba(43, 24, 15, 0.14)'"
    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
    <img src="{{ route('menu.image', ['menu_id' => $item->menu_id]) }}" class="card-img-top" alt="{{ $item->menu_name }}"
        style="height: 220px; object-fit: cover;">

    <div class="card-body d-flex flex-column gap-2 p-4">
        <h3 class="h5 mb-0">{{ $item->menu_name }}</h3>
        <p class="mb-0 fw-semibold" style="color: #de6f2d;">฿{{ number_format($item->price, 2) }}</p>
    </div>
</button>
