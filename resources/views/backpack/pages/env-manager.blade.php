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
    <button id="create-new-backup-button" href="" class="btn btn-success mb-2">
        <i class="las la-cloud-upload-alt"></i>
        <span>Importar</span>
    </button>
    <button id="create-new-backup-button" href="" class="btn btn-primary mb-2">
        <i class="las la-cloud-download-alt"></i>
        <span>Descargar plantilla</span>
    </button>

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
                                <a class="btn btn-sm btn-link" data-button-type="delete" href="">
                                    <i class="la la-trash-o"></i> {{ trans('backpack::backup.delete') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
    <script></script>
@endsection
