@forelse($role->permissions as $permiso)
    <span class="badge badge-light-info">{{$permiso->name}}</span>
@empty
    <span class="badge badge-light-warning">Sin permisos</span>
@endforelse
