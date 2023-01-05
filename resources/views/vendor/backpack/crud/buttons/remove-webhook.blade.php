<button class="btn btn-sm btn-danger remove-webhook-{{ $entry->id }}-js" data-bot-id="{{ $entry->id }}">Eliminar WH</button>

<script type="text/javascript">
    $('.remove-webhook-{{ $entry->id }}-js').on('click', function(event) {
        var botId = $(this).data('bot-id');
        $.ajax({
            type: 'POST',
            url: "{{ route('removeWebhookBot') }}",
            data: {
                botId: botId
            },
            success: function(result) {
                console.log("hola")
                new Noty({
                    type: "success",
                    text: result.message,
                }).show();
            }
        });
    })
</script>
