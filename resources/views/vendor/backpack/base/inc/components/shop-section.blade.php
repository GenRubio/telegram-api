<li class="nav-title">{{ trans('back-office.backpack_menu.labels.shop') }}</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('order') }}">
        @php
            $newOrders = (new App\Services\OrderService())->getCompletedPaymentOrders();
        @endphp
        <i class="nav-icon las la-truck"></i> {{ trans('back-office.backpack_menu.buttons.orders') }} @if (count($newOrders))
            <span class="badge badge-pill badge-warning mr-4">{{ count($newOrders) }}</span>
        @endif
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('product-model') }}">
        <i class="nav-icon las la-clipboard-list"></i> {{ trans('back-office.backpack_menu.buttons.products') }}
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('brand') }}">
        <i class="nav-icon las la-pen"></i> {{ trans('back-office.backpack_menu.buttons.brands') }}
    </a>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('affiliate') }}"><i
            class="nav-icon las la-hands-helping"></i> {{ trans('back-office.backpack_menu.buttons.affiliates') }}</a>
</li>
