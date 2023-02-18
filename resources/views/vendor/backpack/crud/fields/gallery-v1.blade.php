@php
    
@endphp
@include('crud::fields.inc.wrapper_start')

<label>{!! $field['label'] !!}</label>

<div class="gallery" id="gallery">

</div>
<a id="gallery-add" class="btn btn-primary" style="cursor: pointer;">+ Añadir</a>
{{-- 
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
    </div> --}}

<div id="layout-item">
    <div id="item-[id_item]" class="d-none gallery-item_container shadow-sm" data-id="[id_item]">
        <div class="gallery-item_container_remove" data-id="[id_item]">
            <i class="lar la-times-circle"></i>
        </div>
        <div>
            <h5>Item [id_item]</h5>
        </div>
        <div class="gallery-item_container_content">
            <div class="image-container">
                <img src="{{ url('images/backpack/fields/gallery-default.png') }}" id="previewImage-[id_item]"
                    class="preview">
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="gallery_item_image-[id_item]" data-id="[id_item]"
                    name="gallery_item_image_[id_item]">
                <label class="custom-file-label" for="customFileLang">Seleccionar Imagen</label>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">ALT</span>
                </div>
                <input name="gallery_item_alt_[id_item]" type="text" class="form-control" placeholder="Alt"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</div>

@include('crud::fields.inc.wrapper_end')
@push('crud_fields_styles')
    <style type="text/css">
        .custom-file {
            margin-bottom: 10px;
        }

        .preview {
            max-width: 100%;
            max-height: 300px;
        }

        .image-container {
            margin-bottom: 30px;
        }

        .gallery-item_container_content {
            margin-top: 35px
        }

        .gallery-item_container_remove {
            position: absolute;
            right: 0;
            margin-right: 5px;
            z-index: 9999;
        }

        .gallery-item_container_remove i {
            font-size: 25px;
            cursor: pointer;
            z-index: 9999;
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
            $("form").attr("enctype", "multipart/form-data");
            var lastNumber = 1;
            $('#gallery-add').on('click', function(ev) {
                ev.preventDefault();
                let item = $('#layout-item').clone();
                let itemHtml = item.html().replaceAll("[id_item]", lastNumber);
                itemHtml = itemHtml.replace("d-none", "");
                $("#gallery").prepend(itemHtml);
                lastNumber++;
                loadSortable();
            });

            $(document).on('click', '.gallery-item_container_remove', function(ev) {
                let id = $(this).data("id");
                let item = $("#item-" + id).remove();
            });

            $(document).on('change', '.custom-file-input', function(ev) {
                const file = this.files[0];
                let id = $(this).data("id");
                const previewImage = document.getElementById("previewImage-" + id);
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener("load", function() {
                        previewImage.setAttribute("src", this.result);
                    });
                    reader.readAsDataURL(file);
                } else {
                    previewImage.setAttribute("src", "");
                }
            });

            const loadSortable = () => {
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
            }
        });
    </script>
@endpush
