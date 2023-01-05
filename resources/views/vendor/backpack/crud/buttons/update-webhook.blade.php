<button class="btn btn-sm btn-success update-webhook-{{ $entry->id }}-js" data-bot-id="{{ $entry->id }}">Actualizar WH</button>

<script type="text/javascript">
    $('.update-webhook-{{ $entry->id }}-js').on('click', function(event) {
        var botId = $(this).data('bot-id');
        $.ajax({
            type: 'POST',
            url: "{{ route('updateWebhookBot') }}",
            data: {
                botId: botId
            },
            success: function(result) {
                new Noty({
                    type: "success",
                    text: result.message,
                }).show();
            }
        });
    })
</script>
