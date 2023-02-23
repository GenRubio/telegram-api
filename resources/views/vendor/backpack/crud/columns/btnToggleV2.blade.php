@php
    use Illuminate\Support\Str;
    $checked = $entry->{$column['name']} ? true : false;
    $name = $column['name']
@endphp
<td>
    <div id="personal-switch-{{ $entry->id }}_{{ $name }}" class="custom-control custom-switch" data-model="{{ get_class($entry) }}"
        data-target="{{ $entry->id }}" data-field="{{ $column['name'] }}">
        <input type="checkbox" class="custom-control-input" id="customSwitch-{{ $entry->id }}-{{ $name }}"
            {{ $checked ? 'checked' : '' }}>
        <label class="custom-control-label" for="customSwitch-{{ $entry->id }}-{{ $name }}"></label>
    </div>
</td>

<script type="text/javascript">
    $("#personal-switch-{{ $entry->id }}_{{ $name }}").on('click', function(ev) {
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
                    $('#customSwitch-{{ $entry->id }}-{{ $name }}').prop('checked', false);
                }
                else{
                    $('#customSwitch-{{ $entry->id }}-{{ $name }}').prop('checked', true);
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
