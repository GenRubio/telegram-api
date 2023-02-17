@php
    
@endphp
@include('crud::fields.inc.wrapper_start')

<label>{!! $field['label'] !!}</label>

<div class="gallery" id="gallery">
    <div class="gallery-item_container shadow-sm" data-id="1">
        <div class="gallery-item_container_remove">
            <i class="lar la-times-circle"></i>
        </div>
        <div>
            <h5>Item 1</h5>
        </div>
        <div class="gallery-item_container_content">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">ALT</span>
                </div>
                <input type="text" class="form-control" placeholder="Alt" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</div>

@include('crud::fields.inc.wrapper_end')
@push('crud_fields_styles')
    <style type="text/css">
        .gallery-item_container_content {
            margin-top: 35px
        }

        .gallery-item_container_remove {
            position: absolute;
            right: 0;
            margin-right: 5px;
        }

        .gallery-item_container_remove i {
            font-size: 25px;
            cursor: pointer;
        }

        .gallery-item_container {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #80808045;
            border-radius: 5px;
            position: relative;
            cursor: pointer;
        }
    </style>
@endpush

@push('crud_fields_scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        //https://www.youtube.com/watch?v=-N515SDoYuU
        //https://github.com/SortableJS/Sortable
        $(document).ready(function() {
            var el = document.getElementById('gallery');
            Sortable.create(el, {
                animation: 150,
                chosenClass: "seleccionado",
                // ghostClass: "fantasma"
                dragClass: "drag",

                onEnd: () => {
                    console.log('Se inserto un elemento');
                },
                group: "lista-personas",
                store: {
                    // Guardamos el orden de la lista
                    set: (sortable) => {
                        const orden = sortable.toArray();
                        localStorage.setItem(sortable.options.group.name, orden.join('|'));
                    },

                    // Obtenemos el orden de la lista
                    get: (sortable) => {
                        const orden = localStorage.getItem(sortable.options.group.name);
                        return orden ? orden.split('|') : [];
                    }
                }
            });
        });
    </script>
@endpush
