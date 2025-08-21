
<li class="nav-item">
    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Roles</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('userConfigurations.index') }}" class="nav-link {{ Request::is('userConfigurations*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Configurations</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('compraRequisicions.index') }}" class="nav-link {{ Request::is('compraRequisicions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Compra Requisicions</p>
    </a>
</li>
