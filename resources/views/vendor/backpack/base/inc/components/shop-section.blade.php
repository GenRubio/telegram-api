<li class="nav-title">TIENDA</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('order') }}">
        @php
            $newOrders = (new App\Services\OrderService())->getCompletedPaymentOrders();
        @endphp
        <i class="nav-icon las la-truck"></i> Pedidos @if (count($newOrders))
            <span class="badge badge-pill badge-warning mr-4">{{ count($newOrders) }}</span>
        @endif
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('product-model') }}">
        <i class="nav-icon las la-clipboard-list"></i> Productos
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('brand') }}">
        <i class="nav-icon las la-pen"></i> Marcas
    </a>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('affiliate') }}"><i
            class="nav-icon las la-hands-helping"></i> Afiliados</a></li>
