<a href="{{ url($crud->route . '/' . $entry->getKey()) }}/order-product" class="btn btn-sm btn-link"
    style="color: #7c69ef !important; cursor: pointer !important;"><i class="la la-eye"></i> Productos ({{ $entry->orderProducts->count() }})</a>
