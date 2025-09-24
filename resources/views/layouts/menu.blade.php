
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

<li class="nav-item">
    <a href="{{ route('redProduccionResultados.index') }}" class="nav-link {{ Request::is('redProduccionResultados*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Red Produccion Resultados</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('redProduccionProgramas.index') }}" class="nav-link {{ Request::is('redProduccionProgramas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Red Produccion Programas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('redProduccionSubProgramas.index') }}" class="nav-link {{ Request::is('redProduccionSubProgramas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Red Produccion Sub Programas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('redProduccionProyectos.index') }}" class="nav-link {{ Request::is('redProduccionProyectos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Red Produccion Proyectos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('redProduccionProductos.index') }}" class="nav-link {{ Request::is('redProduccionProductos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Red Produccion Productos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('redProduccionSubProductos.index') }}" class="nav-link {{ Request::is('redProduccionSubProductos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Red Produccion Sub Productos</p>
    </a>
</li>
