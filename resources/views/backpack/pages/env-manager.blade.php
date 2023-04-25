@extends(backpack_view('layouts.top_left'))

@php
$breadcrumbs = [
    trans('backpack::crud.admin') => backpack_url('dashboard'),
    trans('backpack::backup.backups') => false,
];
@endphp

@section('header')
<section class="container-fluid">
    <h2><span class="text-capitalize">{{ trans('backpack::backup.backups') }}</span></h2>
</section>
@endsection

@section('content')
{{-- Default box --}}
<button id="create-new-backup-button" href="" class="btn btn-primary mb-2">
    <i class="la la-spinner"></i>
    <i class="la la-plus"></i>
    <span>{{ trans('backpack::backup.create_a_new_backup') }}</span>
</button>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover pb-0 mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('backpack::backup.location') }}</th>
                    <th>{{ trans('backpack::backup.date') }}</th>
                    <th class="text-right">{{ trans('backpack::backup.file_size') }}</th>
                    <th class="text-right">{{ trans('backpack::backup.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($backups as $key => $backup)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $backup->diskName }}</td>
                    <td>{{ $backup->lastModified }}</td>
                    <td class="text-right">{{ $backup->fileSize }} MB</td>
                    <td class="text-right">
                        @if ($backup->downloadLink)
                        <a class="btn btn-sm btn-link" data-button-type="download" href="{{ $backup->downloadLink }}">
                            <i class="la la-cloud-download"></i> {{ trans('backpack::backup.download') }}
                        </a>
                        @endif
                        <a class="btn btn-sm btn-link" data-button-type="delete" href="{{ $backup->deleteLink }}">
                            <i class="la la-trash-o"></i> {{ trans('backpack::backup.delete') }}
                        </a>
                    </td>
                </tr>
                @endforeach --}}
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
<script>
    
</script>
@endsection