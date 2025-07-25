<div class="row">
    <div class="col-sm-6">

        <div class="mb-2">
            <label for="id">Id:</label>
            <div><strong>{{ $solicitude->id }}</strong></div>
        </div>

        <div class="mb-2">
            <label for="codigo">Código:</label>
            <div><strong>{{ $solicitude->codigo }}</strong></div>
        </div>

        <div class="mb-2">
            <label for="departamento">Departamento solicita:</label>
            <div><strong>{{ $solicitude->unidad->nombre ?? '' }}</strong></div>
        </div>

        <div class="mb-2">
            <label for="fecha_solicita">Fecha solicita:</label>
            <div><strong>{{ fechaLtn($solicitude->fecha_solicita) }}</strong></div>
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
            <label for="solicitante">Solicitante:</label>
            <div><strong>{{ $solicitude->usuarioSolicita->name ?? '' }}</strong></div>
        </div>

        @if ($solicitude->estaDespachada())
            <div class="mb-2">
                <label for="usuario_despacha">Usuario que despacha:</label>
                <div><strong>{{ $solicitude->usuarioDespacha->name ?? '' }}</strong></div>
            </div>

            <div class="mb-2">
                <label for="fecha_despacha">Despachada el:</label>
                <div><strong>{{ fechaLtn($solicitude->fecha_despacha) }}</strong></div>
            </div>
        @endif

        @if (!empty($solicitude->motivo_retorna))
            <div class="mb-2">
                <label for="motivo_retorna">Motivo de retorno:</label>
                <div><strong>{{ $solicitude->motivo_retorna }}</strong></div>
            </div>
        @endif

    </div>

    <div class="col-12 mt-3">
        <label for="justificacion">Justificación:</label>
        <div><strong>{{ $solicitude->justificacion }}</strong></div>
    </div>
</div>
