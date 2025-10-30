<div class="row">
    <div class="col-sm-6">

        <div class="mb-2">
            <label for="id">Id:</label>
            <div><strong>{{ $solicitude->id }}</strong></div>
        </div>



        <div class="mb-2">
            <label for="departamento">Unidad solicita:</label>
            <div><strong>{{ $solicitude->unidad->nombre ?? '' }}</strong></div>
        </div>

        <div class="mb-2">
            <label for="solicitante">Usuario Solicita:</label>
            <div><strong>{{ $solicitude->usuarioSolicita->name ?? '' }}</strong></div>
        </div>

        <div class="mb-2">
            <label for="solicitante">Usuario Autoriza:</label>
            <div><strong>{{ $solicitude->usuarioAutoriza->name ?? '-' }}</strong></div>
        </div>


        <div class="mb-2">
            <label for="usuario_despacha">Usuario despacha:</label>
            <div><strong>{{ $solicitude->usuarioDespacha->name ?? '-' }}</strong></div>
        </div>



    </div>

    <div class="col-sm-6 text-end">

        <div class="mb-2">
            <label for="estado">Estado:</label><br>
            <span class="badge bg-{{ $solicitude->estado->color }}">
                {{ $solicitude->estado->nombre }}
            </span>
        </div>

        <div class="mb-2">
            <label for="folio" >Folio:</label>
            <div><strong class="text-danger">{{ $solicitude->folio }}</strong></div>
        </div>

        <div class="mb-2">
            <label for="fecha_solicita">Fecha solicita:</label>
            <div><strong>{{ $solicitude->fecha_solicita ? fechaLtn($solicitude->fecha_solicita) : "-" }}</strong></div>
        </div>

        <div class="mb-2">
            <label for="fecha_solicita">Fecha Autorización:</label>
            <div><strong>{{ $solicitude->fecha_autoriza ? fechaLtn($solicitude->fecha_autoriza) : '-' }}</strong></div>
        </div>


        <div class="mb-2">
            <label for="fecha_despacha">Fecha Despachada:</label>
            <div><strong>{{ $solicitude->fecha_despacha ? fechaLtn($solicitude->fecha_despacha) : '-' }}</strong></div>
        </div>

        @if (!empty($solicitude->motivo_retorna))
            <div class="mb-2">
                <label for="motivo_retorna">Motivo de retorno:</label>
                <div><strong>{{ $solicitude->motivo_retorna }}</strong></div>
            </div>
        @endif

    </div>

    <div class="col-12 mt-1 mb-1">
        <label for="justificacion">Justificación:</label>
        <div><strong>{{ $solicitude->justificacion }}</strong></div>
    </div>
</div>
