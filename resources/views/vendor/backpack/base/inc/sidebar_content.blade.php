{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-title">TIENDA</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('product-model') }}"><i class="nav-icon la la-question"></i> Productos</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('brand') }}"><i class="nav-icon la la-question"></i> Marcas</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('order') }}"><i class="nav-icon la la-question"></i> Pedidos</a></li>
<li class="nav-title">TELEGRAM BOT</li>
<li class="nav-title">CONFIGURACION</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('api-client') }}"><i class="nav-icon la la-question"></i> API Clientes</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('language') }}"><i class="nav-icon la la-question"></i> Idiomas</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('translation') }}"><i class="nav-icon la la-question"></i> Traducciones</a></li>