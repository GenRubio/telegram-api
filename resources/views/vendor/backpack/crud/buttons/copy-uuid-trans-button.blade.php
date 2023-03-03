<a class="btn btn-sm btn-link" data-helper="{{ $entry->uuid }}" id="copy-to-clipboard-{{ $entry->getKey() }}"
    style="color: #7c69ef !important; cursor: pointer !important;">
    <i class="lar la-copy"></i> Copiar UUID
</a>

<script>
    (function() {
        let copyToClipboardButton = document.getElementById("copy-to-clipboard-{{ $entry->getKey() }}");
        copyToClipboardButton.addEventListener("click", function() {
            navigator.clipboard.writeText(this.getAttribute('data-helper'));
            new Noty({
                type: "success",
                text: "<strong>UUID copiado</strong><br>El uuid se ha copiado a portapapeles correctamente."
            }).show();
        });
    })();
</script>
