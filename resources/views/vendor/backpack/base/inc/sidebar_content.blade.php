{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('product-model') }}"><i class="nav-icon la la-question"></i> Productos</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('order') }}"><i class="nav-icon la la-question"></i> Pedidos</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('brand') }}"><i class="nav-icon la la-question"></i> Marcas</a></li>