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
                    <input type="checkbox" name="perm_{{ $crud }}_{{ $permis->name }}" > {{ $permis->name }}
                </div>
            @endforeach
        </div>
    @endforeach
</div>
