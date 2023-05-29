<style>
    .custom-dropdown-item {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }
</style>
<span class="dropdown">
    <button class="btn btn-sm btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Acciones
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/product-models-flavor">
            <i class="las la-plus"></i> Sabores ({{ $entry->productModelsFlavors->count() }})
        </a>
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/gallery-product">
            <i class="las la-plus"></i> Imagenes ({{ $entry->galleryImagesAll->count() }})
        </a>
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/product-model-valoration">
            <i class="las la-plus"></i> Valoraciones ({{ $entry->valorationsAll->count() }})
        </a>
        <a class="dropdown-item custom-dropdown-item"
            href="{{ url($crud->route . '/' . $entry->getKey()) }}/duplicate">
            <i class="las la-copy"></i> Duplicar
        </a>
    </div>
</span>
