{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@if(backpack_user()->officePermission('TranslationCrudController', 'show'))
<li class="nav-title">WEB APP</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('translation') }}"><i class="nav-icon la la-question"></i> Traducciones</a></li>
@endif
@if(backpack_user()->officePermission('ProductModelCrudController', 'show')
|| backpack_user()->officePermission('BrandCrudController', 'show')
|| backpack_user()->officePermission('OrderCrudController', 'show'))
<li class="nav-title">TIENDA</li>
  @if(backpack_user()->officePermission('ProductModelCrudController', 'show'))
  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('product-model') }}"><i class="nav-icon la la-question"></i> Productos</a></li>
  @endif
  @if(backpack_user()->officePermission('BrandCrudController', 'show'))
  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('brand') }}"><i class="nav-icon la la-question"></i> Marcas</a></li>
  @endif
  @if(backpack_user()->officePermission('OrderCrudController', 'show'))
  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('order') }}"><i class="nav-icon la la-question"></i> Pedidos</a></li>
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
       <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-question"></i> Bots</a>
       <ul class="nav-dropdown-items">
           @if(backpack_user()->officePermission('BotCrudController', 'show'))
           <li class="nav-item"><a class="nav-link" href="{{ backpack_url('bot') }}"><i class="nav-icon la la-question"></i> Bots</a></li>
           @endif
           @if(backpack_user()->officePermission('TelegramBotGroupCrudController', 'show'))
           <li class="nav-item"><a class="nav-link" href="{{ backpack_url('telegram-bot-group') }}"><i class="nav-icon la la-question"></i> Grupos</a></li>
           @endif
       </ul>
   </li>
   @endif
   @if(backpack_user()->officePermission('TelegramBotMessageCrudController', 'show')
   || backpack_user()->officePermission('TelegramBotGlobalMessageCrudController', 'show'))
   <li class="nav-item nav-dropdown">
       <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-question"></i> Mensajes</a>
       <ul class="nav-dropdown-items">
           @if(backpack_user()->officePermission('TelegramBotMessageCrudController', 'show'))
           <li class="nav-item"><a class="nav-link" href="{{ backpack_url('telegram-bot-message') }}"><i class="nav-icon la la-question"></i> Mensajes</a></li>
           @endif
           @if(backpack_user()->officePermission('TelegramBotGlobalMessageCrudController', 'show'))
           <li class="nav-item"><a class="nav-link" href="{{ backpack_url('telegram-bot-global-message') }}"><i class="nav-icon la la-question"></i> Globales</a></li>
           @endif       
        </ul>
   </li>
   @endif
   @if(backpack_user()->officePermission('BotTranslationCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('bot-translation') }}"><i class="nav-icon la la-question"></i> Traducciones</a></li>
   @endif
@endif
@if(backpack_user()->officePermission('LanguageCrudController', 'show')
|| backpack_user()->officePermission('ApiClientCrudController', 'show')
|| backpack_user()->officePermission('GeocodingApiCrudController', 'show')
|| backpack_user()->officePermission('SettingCrudController', 'show'))
<li class="nav-title">CONFIGURACION</li>
   @if(backpack_user()->officePermission('LanguageCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('language') }}"><i class="nav-icon la la-question"></i> Idiomas</a></li>
   @endif
   @if(backpack_user()->officePermission('ApiClientCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('api-client') }}"><i class="nav-icon la la-question"></i> API Clientes</a></li>
   @endif
   @if(backpack_user()->officePermission('GeocodingApiCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('geocoding-api') }}"><i class="nav-icon la la-question"></i> Geocoding</a></li>
   @endif
   @if(backpack_user()->officePermission('SettingCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('setting') }}"><i class="nav-icon la la-question"></i> Configuración</a></li>
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> Elfinder</a></li>
   @endif
@endif
@if(backpack_user()->officePermission('UserCrudController', 'show')
|| backpack_user()->officePermission('OfficePermissionCrudController', 'show'))
<li class="nav-title">USUARIOS</li>
   @if(backpack_user()->officePermission('UserCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-question"></i> Usuarios</a></li>
   @endif
   @if(backpack_user()->officePermission('OfficePermissionCrudController', 'show'))
   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('office-permission') }}"><i class="nav-icon la la-question"></i> Permisos</a></li>
   @endif
@endif
