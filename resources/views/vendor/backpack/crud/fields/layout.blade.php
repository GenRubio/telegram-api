@php
    
@endphp
@include('crud::fields.inc.wrapper_start')

<label>{!! $field['label'] !!}</label>

@include('crud::fields.inc.wrapper_end')
@push('crud_fields_styles')
    <style type="text/css">

    </style>
@endpush

@push('crud_fields_scripts')
    <script>
         $(document).ready(function() {

         });
    </script>
@endpush
