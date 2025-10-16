@forelse($user->roles as $rol)
    <span class="badge text-bg-info">{{$rol->name}}</span>
@empty
    <span class="badge text-bg-default">Ninguno</span>
@endforelse

