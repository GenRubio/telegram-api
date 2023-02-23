@php
    $checked = $entry->{$column['name']} ? true : false;
    $key = encript($entry->name);
@endphp
<td>
    <div id="personal-switch-{{ $entry->id }}_{{ $key }}" class="custom-control custom-switch" data-model="{{ get_class($entry) }}"
        data-target="{{ $entry->id }}" data-field="{{ $column['name'] }}">
        <input type="checkbox" class="custom-control-input" id="customSwitch-{{ $entry->id }}-{{ $key }}"
            {{ $checked ? 'checked' : '' }}>
        <label class="custom-control-label" for="customSwitch-{{ $entry->id }}-{{ $key }}"></label>
    </div>
</td>

<script type="text/javascript">
    $("#personal-switch-{{ $entry->id }}_{{ $key }}").on('click', function(ev) {
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
                    $('#customSwitch-{{ $entry->id }}-{{ $key }}').prop('checked', false);
                }
                else{
                    $('#customSwitch-{{ $entry->id }}-{{ $key }}').prop('checked', true);
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
