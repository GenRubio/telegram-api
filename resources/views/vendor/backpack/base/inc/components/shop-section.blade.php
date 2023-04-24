@if (backpack_user()->officePermission('ProductModelCrudController', 'show') ||
        backpack_user()->officePermission('BrandCrudController', 'show') ||
        backpack_user()->officePermission('OrderCrudController', 'show') ||
        backpack_user()->officePermission('AffiliateCrudController', 'show'))
    <li class="nav-title">TIENDA</li>
    @if (backpack_user()->officePermission('OrderCrudController', 'show'))
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('order') }}">
                @php 
                    $newOrders = (new App\Services\OrderService())->getCompletedPaymentOrders();
                @endphp
                <i class="nav-icon las la-truck"></i> Pedidos @if(count($newOrders))<span class="badge badge-pill badge-warning mr-4">{{ count($newOrders) }}</span>@endif
            </a>
        </li>
    @endif
    @if (backpack_user()->officePermission('ProductModelCrudController', 'show'))
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('product-model') }}">
                <i class="nav-icon las la-clipboard-list"></i> Productos
            </a>
        </li>
    @endif
    @if (backpack_user()->officePermission('BrandCrudController', 'show'))
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('brand') }}">
                <i class="nav-icon las la-pen"></i> Marcas
            </a>
        </li>
    @endif
    @if (backpack_user()->officePermission('AffiliateCrudController', 'show'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('affiliate') }}"><i
                    class="nav-icon las la-hands-helping"></i> Afiliados</a></li>
    @endif
@endif
