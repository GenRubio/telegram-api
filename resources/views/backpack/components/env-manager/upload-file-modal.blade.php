<div class="modal fade" id="uploadEnvFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="background-color:#0000005c">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload File</h5>
                <button type="button" id="close-modal-button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uplaod-file-env" data-url="{{ backpack_url('env-keys/upload') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Example: env-keys<b>.json</b></label>
                        <input name="env_file" class="form-control" type="file" id="formFile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="import-modal-button" class="btn btn-success">Importar</button>
                    <button type="button" id="cancel-modal-button" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
