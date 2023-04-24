{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
{{-- https://icons8.com/line-awesome --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@include('backpack::base.inc.components.shop-section')
@include('backpack::base.inc.components.bot-section')
@include('backpack::base.inc.components.config-section')
@include('backpack::base.inc.components.admin-section')