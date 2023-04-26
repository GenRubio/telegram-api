<div class="modal fade" id="showEnvData{{ $item['uuid'] }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color:#0000005c">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Env data: {{ $item['uuid'] }}</h5>
                <button type="button" id="close-modal-button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="width:100%;overflow-x:scroll">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Key</th>
                                <th scope="col">Value</th>
                                <th scope="col">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item['parameters'] as $parameter)
                                <tr>
                                    <td>{{ $item['type'] }}</td>
                                    <td>{{ $parameter['name'] }}</td>
                                    <td>{{ $parameter['value'] }}</td>
                                    <td>{{ $item['active'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 15px;">
                    <b>Description:</b>
                    <hr>
                    {{ $item['description'] }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancel-modal-button" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
