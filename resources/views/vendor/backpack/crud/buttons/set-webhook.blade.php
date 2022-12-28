<button class="btn btn-sm btn-success set-webhook-js" data-bot-id="{{ $entry->id }}">Actualizar</button>

<script type="text/javascript">
    $('.set-webhook-js').on('click', function(event) {
        var botId = $(this).data('bot-id');
        $.ajax({
            type: 'POST',
            url: "{{ route('setWebhookBot') }}",
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
