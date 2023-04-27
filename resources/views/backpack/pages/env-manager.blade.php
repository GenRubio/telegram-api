@extends(backpack_view('layouts.top_left'))

@php
    $breadcrumbs = [
        trans('backpack::crud.admin') => backpack_url('dashboard'),
        'Env' => false,
    ];
@endphp

@section('header')
    <section class="container-fluid">
        <h2><span class="text-capitalize">Credenciales Env</span></h2>
    </section>
@endsection

@section('content')
    {{-- Default box --}}
    <button id="import-env-config" href="" class="btn btn-success mb-2" data-style="zoom-in" data-toggle="modal"
        data-target="#uploadEnvFile" data-backdrop="false">
        <i class="las la-cloud-upload-alt"></i>
        <span>Importar</span>
    </button>
    <a id="download-env-config" href="{{ backpack_url('env-keys/download') }}" class="btn btn-primary mb-2">
        <i class="las la-cloud-download-alt"></i>
        <span>Descargar plantilla</span>
    </a>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover pb-0 mb-0">
                <thead>
                    <tr>
                        <th>UUID</th>
                        <th>Tipo</th>
                        <th>Descripcion</th>
                        <th class="text-right">{{ trans('backpack::backup.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item['uuid'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>{{ $item['description'] }}</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-link" id="show-modal" data-button-type="delete" href=""
                                    style="color: #7c69ef !important; cursor: pointer !important;" data-style="zoom-in"
                                    data-toggle="modal" data-target="#showEnvData{{ $item['uuid'] }}" data-backdrop="false">
                                    <i class="las la-eye"></i> Examinar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($data as $item)
        @include('backpack.components.env-manager.view-modal', ['item' => $item])
    @endforeach
    @include('backpack.components.env-manager.upload-file-modal')
@endsection

@section('after_styles')
    <style>
        #create-new-backup-button.loading>.la-spinner {
            display: inherit;
            animation: rotation 1s steps(8, end) infinite;
        }

        #create-new-backup-button>.la-spinner,
        #create-new-backup-button.loading>.la-plus {
            display: none;
        }

        @keyframes rotation {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(359deg);
            }
        }
    </style>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function() {
            const notyAlert = (title, message = '', type = 'success') => new Noty({
                text: `<strong>${title}</strong><br>${message}`,
                type
            }).show();
            $(document).on('submit', '#uplaod-file-env', function(ev) {
                ev.preventDefault();
                let buttonSend = $('#import-modal-button');
                buttonSend.attr('disabled', true);
                let url = $(this).data('url');
                let formData = new FormData(this);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        buttonSend.attr('disabled', false);
                        if (data.success) {
                            notyAlert(data.title, data.message);
                            location.reload();
                        } else {
                            notyAlert(data.title, data.message, 'error');
                        }
                    },
                    error: function(data) {
                        buttonSend.attr('disabled', false);
                    }
                })
            })
        })
    </script>
@endsection
