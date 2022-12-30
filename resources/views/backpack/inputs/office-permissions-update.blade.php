@php
    use App\Models\OfficePermission;
    $permissions = OfficePermission::get();
    $cruds = $permissions
        ->pluck('crud_controller')
        ->unique()
        ->toArray();

@endphp
<label>Permisos</label>
<div class="row">
    @foreach ($cruds as $crud)
        <div class="col-4 mb-2">
            <b>{{ str_replace('CrudController', '', $crud) }}</b>
            @foreach ($permissions->where('crud_controller', $crud) as $permis)
                <div>
                    @if (is_null($user->officePermissions()->where('office_permission_id', $permis->id)->first()))
                        <input type="checkbox" name="perm_{{ $crud }}_{{ $permis->name }}"> {{ $permis->name }}
                    @else
                        <input type="checkbox" name="perm_{{ $crud }}_{{ $permis->name }}" checked> {{ $permis->name }}
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>
