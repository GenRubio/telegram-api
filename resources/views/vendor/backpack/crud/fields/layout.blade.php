@php
    
@endphp
@include('crud::fields.inc.wrapper_start')

<label>{!! $field['label'] !!}</label>

@include('crud::fields.inc.wrapper_end')
@push('crud_fields_styles')
    @loadOnce('upload_field_styles')
        <style type="text/css">
            
        </style>
    @endLoadOnce
@endpush

@push('crud_fields_scripts')
    @loadOnce('bpFieldInitUploadElement')
        <script></script>
    @endLoadOnce
@endpush
