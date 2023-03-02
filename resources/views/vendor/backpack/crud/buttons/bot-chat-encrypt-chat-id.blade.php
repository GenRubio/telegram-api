@php
    $hash = encrypt($entry->chat_id);
@endphp
<a class="btn btn-sm btn-link" data-helper="{{ $hash }}" id="copy-to-clipboard-{{ $entry->getKey() }}"
    style="color: #7c69ef !important; cursor: pointer !important;">
    <i class="lar la-copy"></i> Copiar hash
</a>

<script>
    (function() {
        let copyToClipboardButton = document.getElementById("copy-to-clipboard-{{ $entry->getKey() }}");
        copyToClipboardButton.addEventListener("click", function() {
            navigator.clipboard.writeText(this.getAttribute('data-helper'));
            new Noty({
                type: "success",
                text: "<strong>Hash copiado</strong><br>El hash se ha copiado a portapapeles correctamente."
            }).show();
        });
    })();
</script>
