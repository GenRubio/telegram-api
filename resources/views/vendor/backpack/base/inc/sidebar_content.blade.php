{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
{{-- https://icons8.com/line-awesome --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@if(backpack_user()->officePermission('TranslationCrudController', 'show'))
<li class="nav-title">WEB APP</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('translation') }}"><i class="nav-icon las la-language"></i> Traducciones</a></li>
@endif
@if(backpack_user()->officePermission('ProductModelCrudController', 'show')
|| backpack_user()->officePermission('BrandCrudController', 'show')
|| backpack_user()->officePermission('OrderCrudController', 'show'))
<li class="nav-title">TIENDA</li>
  @if(backpack_user()->officePermission('ProductModelCrudController', 'show'))
  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('product-model') }}"><i class="nav-icon las la-clipboard-list"></i> Productos</a></li>
  @endif
  @if(backpack_user()->officePermission('BrandCrudController', 'show'))
  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('brand') }}"><i class="nav-icon las la-pen"></i> Marcas</a></li>
  @endif
  @if(backpack_user()->officePermission('OrderCrudController', 'show'))
  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('order') }}"><i class="nav-icon las la-truck"></i> Pedidos</a></li>
  @endif
@endif
@if(backpack_user()->officePermission('BotCrudController', 'show')
|| backpack_user()->officePermission('TelegramBotGroupCrudController', 'show')
|| backpack_user()->officePermission('TelegramBotMessageCrudController', 'show')
|| backpack_user()->officePermission('TelegramBotGlobalMessageCrudController', 'show'))
<li class="nav-title">TELEGRAM BOT</li>
   @if(backpack_user()->officePermission('BotCrudController', 'show')
   || backpack_user()->officePermission('TelegramBotGroupCrudController', 'show'))
   <li class="nav-item nav-dropdown">
       <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-robot"></i> Bots</a>
       <ul class="nav-dropdown-items">
           @if(backpack_user()->officePermission('BotCrudController', 'show'))
           <li class="nav-item"><a class="nav-link" href="{{ backpack_url('bot') }}"><i class="nav-icon las la-robot"></i> Bots</a></li>
           @endif
           @if(backpack_user()->officePermission('TelegramBotGroupCrudController', 'show'))
           <li class="nav-item"><a class="nav-link" href="{{ backpack_url('telegram-bot-group') }}"><i class="nav-icon las la-list"></i> Grupos</a></li>
           @endif
       </ul>
   </li>
   @endif
   @if(backpack_user()->officePermission('TelegramBotMessageCrudController', 'show')
   || backpack_user()->officePermission('TelegramBotGlobalMessageCrudController', 'show'))
   <li class="nav-item nav-dropdown">
       <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-comments"></i> Mensajes</a>
       <ul class="nav-dropdown-items">
           @if(backpack_user()->officePermission('TelegramBotMessageCrudController', 'show'))
           <li class="nav-item"><a class="nav-link" href="{{ backpack_url('telegram-bot-message') }}"><i class="nav-icon las la-comment-alt"></i> Mensajes</a></li>
           @endif
           @if(backpack_user()->officePermission('TelegramBotGlobalMessageCrudController', 'show'))
           <li class="nav-item"><a class="nav-link" href="{{ backpack_url('telegram-bot-global-message') }}"><i class="nav-icon las la-sms"></i> Globales</a></li>
           @endif       
        </ul>
   </li>
   @endif
   @if(backpack_user()->officePermission('BotTranslationCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('bot-translation') }}"><i class="nav-icon las la-language"></i> Traducciones</a></li>
   @endif
@endif
@if(backpack_user()->officePermission('AffiliateCrudController', 'show'))
<li class="nav-title">AFILIADOS</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('affiliate') }}"><i class="nav-icon las la-hands-helping"></i> Afiliados</a></li>
@endif
@if(backpack_user()->officePermission('LanguageCrudController', 'show')
|| backpack_user()->officePermission('ApiClientCrudController', 'show')
|| backpack_user()->officePermission('GeocodingApiCrudController', 'show')
|| backpack_user()->officePermission('SettingCrudController', 'show'))
<li class="nav-title">CONFIGURACION</li>
   @if(backpack_user()->officePermission('LanguageCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('language') }}"><i class="nav-icon las la-globe"></i> Idiomas</a></li>
   @endif
   @if(backpack_user()->officePermission('ApiClientCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('api-client') }}"><i class="nav-icon las la-server"></i> API Clientes</a></li>
   @endif
   @if(backpack_user()->officePermission('GeocodingApiCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('geocoding-api') }}"><i class="nav-icon las la-database"></i> Geocoding</a></li>
   @endif
   @if(backpack_user()->officePermission('SettingCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('setting') }}"><i class="nav-icon las la-tools"></i> Configuración</a></li>
   @endif
@endif
<li class="nav-title">Tablas parametricas</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('parametric-table') }}"><i class="nav-icon la la-th-list"></i> Tablas</a></li>
<li class="nav-item nav-dropdown">
   <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-th-list"></i> Valores</a>
   <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('settings-table') }}"><i class="nav-icon la la-th-list"></i> Configuración</a></li>
   </ul>
</li>
@if(backpack_user()->officePermission('UserCrudController', 'show'))
<li class="nav-title">SERVIDOR</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> Elfinder</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon la la-hdd-o'></i> Backups</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Logs</a></li>
@endif
@if(backpack_user()->officePermission('UserCrudController', 'show')
|| backpack_user()->officePermission('OfficePermissionCrudController', 'show'))
<li class="nav-title">USUARIOS</li>
   @if(backpack_user()->officePermission('UserCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon las la-users"></i> Usuarios</a></li>
   @endif
   @if(backpack_user()->officePermission('OfficePermissionCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('office-permission') }}"><i class="nav-icon las la-folder-open"></i> Permisos</a></li>
   @endif
@endif