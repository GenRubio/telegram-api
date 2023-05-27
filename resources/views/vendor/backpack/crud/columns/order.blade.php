<style>
    .order-list {
        width: 60px;
    }
</style>
<select class="order-list" id="order-list-input-{{ $entry->id }}" value="{{ $entry->order }}">
    @php
        $serviceObject = str_replace('App\Models\\', '\App\Services\\', get_class($entry) . 'Service');
        $service = new $serviceObject();
        $allResults = $service->getAll();
    @endphp
    @for ($i = 1; $i <= $allResults->count(); $i++)
        @if ($i == $entry->order)
            <option value="{{ $i }}" selected>{{ $i }}</option>
        @else
            <option value="{{ $i }}">{{ $i }}</option>
        @endif
    @endfor
</select>

<script type="text/javascript">
    $("#order-list-input-{{ $entry->id }}").on('change', function(ev) {
        $.ajax({
            type: 'POST',
            url: "{{ route('updateOrder') }}",
            data: {
                id: "{{ $entry->id }}",
                order: $(this).val(),
                token: "{{ csrf_token() }}",
                field: "{{ $column['name'] }}",
                model: "{{ get_class($entry) }}"
            },

            success: function(result) {
                new Noty({
                    type: "success",
                    text: "Prioridad actualizada correctamente",
                }).show();
            }
        });
        crud.table.draw();
        ev.preventDefault();
    })
</script>
