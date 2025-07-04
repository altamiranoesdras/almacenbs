<div x-data="test()" x-init="inicio">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        TEST
                    </h2>
                </div>
            </div>
        </div>

        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-primary float-right"
                       href="#">
                        TEST
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="card border-info">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Filtros</h5>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="mb-4" >
        <x-button x-on:click="detectBeacons" >
            Encender Bluethoot
        </x-button>
    </div>

    ID: <span x-text="connectedDevice.id"></span>
    NAME: <span x-text="connectedDevice.name"></span>

    <div class="mb-4" >
        <x-button x-on:click="disconnectBluetooth" >
            DESCONECTAR Bluethoot
        </x-button>
    </div>

    <div class="mb-4" >
        <x-button wire:click="SendWhatsapp" >
            Enviar WATSAPP
        </x-button>
    </div>
    
    <div class="mb-4" >
        <x-button wire:click="GenerarFactura" >
            GENERAR FACTURA
        </x-button>
    </div> --}}

    <div class="mb-4" >
        <div class="btn btn-success" wire:click="sumar">
            SUMAR con Livewire
        </div>
        {{ $resultado }}
    </div>

    {{-- <div class="mb-4" >
        <x-button wire:click="websocket" >
            SUMAR con Websocket
        </x-button>
        <span x-text="resultado"></span>
    </div>

    <div class="mb-4" >
        <x-button wire:click="sendMail" >
            Enviar CORREO
        </x-button>
    </div> --}}

    

    <div>
        <div class="btn btn-primary" x-on:click="sumar">
            SUMAR con ALPINE
        </div>
        <span x-text="resultado"></span>
    </div>

    <div>
        <div class="btn btn-primary" x-on:click="toast">
            TOAST
        </div>
    </div>


    <div>
        <div class="btn btn-success"  x-on:click="toast('HAHAHAHA')">
            TOAST
        </div>
    </div>

    <div>
        <div class="btn btn-danger" x-on:click="mostrarEquiposUsb">
            Mostrar equipos USB
        </div>
    </div>

    <div>
        <div class="btn btn-danger" x-on:click="equiposUsbConectados">
            Equipos Conectados al navegador via USB
        </div>
    </div>

    <div>
        <div class="btn btn-danger" wire:click="obtenerRutasIndexCreate">
            VER LISTADO DE RUTAS
        </div>
    </div>

    @include('livewire.test.test-alpine')
</div>
