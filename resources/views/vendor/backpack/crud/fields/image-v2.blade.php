@php
    
@endphp
@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
<div class="image-container">
    @if (isset($field['value']))
        <img src="{{ url($field['value']) }}" id="previewImage" class="preview">
    @else
        <img id="previewImage" class="preview">
    @endif
</div>
<div class="custom-file">
    <input type="file" class="custom-file-input" id="fileInput" name="{{ $field['name'] }}">
    <label class="custom-file-label" for="customFileLang">Seleccionar Imagen</label>
</div>
@include('crud::fields.inc.wrapper_end')
@push('crud_fields_styles')
    @loadOnce('upload_field_styles')
        <style type="text/css">
            .preview {
                max-width: 100%;
                max-height: 300px;
            }

            .image-container {
                margin-bottom: 10px;
            }
        </style>
    @endLoadOnce
@endpush

@push('crud_fields_scripts')
    @loadOnce('bpFieldInitUploadElement')
        <script>
            $(document).ready(function() {
                $("form").attr("enctype", "multipart/form-data");
                const fileInput = document.getElementById("fileInput");
                const previewImage = document.getElementById("previewImage");

                fileInput.addEventListener("change", function() {
                    const file = this.files[0];

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
            })
        </script>
    @endLoadOnce
@endpush
