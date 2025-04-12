<div class="d-flex justify-content-left align-items-center" >
    <div class="avatar  bg-light-warning  me-1" >
        <img src="{{$user->miniatura}}" alt="Avatar" width="32" height="32">
    </div>
    <div class="d-flex flex-column" >
        <span class="emp_name text-truncate fw-bold">{{$user->name}}</span>
        <small class="emp_post text-truncate text-muted">{{$user->maxRol()->name ?? ''}}</small>
    </div>
</div>
