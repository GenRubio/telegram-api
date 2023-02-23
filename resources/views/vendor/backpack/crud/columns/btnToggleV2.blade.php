@php
    $checked = $entry->{$column['name']} ? true : false;
@endphp
<td>
    <div id="personal-switch-{{ $entry->id }}_{{ $entry->name }}" class="custom-control custom-switch" data-model="{{ get_class($entry) }}"
        data-target="{{ $entry->id }}" data-field="{{ $column['name'] }}">
        <input type="checkbox" class="custom-control-input" id="customSwitch-{{ $entry->id }}-{{ $entry->name }}"
            {{ $checked ? 'checked' : '' }}>
        <label class="custom-control-label" for="customSwitch-{{ $entry->id }}-{{ $entry->name }}"></label>
    </div>
</td>

<script type="text/javascript">
    $("#personal-switch-{{ $entry->id }}_{{ $entry->name }}").on('click', function(ev) {
        var model = $(this).data('model');
        var id = $(this).data('target');
        var field = $(this).data('field');
        $.ajax({
            type: 'POST',
            url: "{{ route('toggleFieldV2') }}",
            data: {
                model: model,
                id: id,
                field: field
            },

            success: function(result) {
                if (!result.checked){
                    $('#customSwitch-{{ $entry->id }}-{{ $entry->name }}').prop('checked', false);
                }
                else{
                    $('#customSwitch-{{ $entry->id }}-{{ $entry->name }}').prop('checked', true);
                }
                new Noty({
                    type: "success",
                    text: "Estado actualizado correctamente",
                }).show();
            }
        });
        ev.preventDefault();
    })
</script>
