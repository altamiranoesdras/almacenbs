<?php

namespace App\DataTables;

use App\Models\Solicitud;
use App\extensiones\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class SolicitudUserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function(Solicitud $solicitud){

                $id = $solicitud->id;

                return view('solicitudes.usuario.datatables_actions',compact('solicitud','id'));

            })
            ->editColumn('usuario_despacha',function (Solicitud $solicitud){
                return $solicitud->usuarioSolicita->name ?? null;
            })
            ->editColumn('codigo',function (Solicitud $solicitud){

                return view('solicitudes.modal_show',compact('solicitud'))->render();

            })
            ->editColumn('justificacion',function (Solicitud $solicitud){

                return str_limit($solicitud->justificacion,30);

            })
            ->editColumn('usuario_autoriza.name',function (Solicitud $solicitud){

                return $solicitud->usuarioAutoriza->name ?? '';

            })
            ->editColumn('usuario_aprueba.name',function (Solicitud $solicitud){

                return $solicitud->usuarioAprueba->name ?? '';

            })
            ->editColumn('usuario_despacha.name',function (Solicitud $solicitud){

                return $solicitud->usuarioDespacha->name ?? '';

            })
            ->editColumn('fecha_solicita',function (Solicitud $solicitud){

                return fechaHoraLtn($solicitud->fecha_solicita);

            })
            ->editColumn('estado.nombre',function (Solicitud $solicitud){

                $color = $solicitud->estado->color;

                return "<span class='badge badge-$color'>{$solicitud->estado->nombre}</span>";

            })
            ->editColumn('fecha_despacha',function (Solicitud $solicitud){

                return fechaHoraLtn($solicitud->fecha_despacha);

            })
            ->rawColumns(['action','codigo','estado.nombre']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Solicitud $model)
    {

        return $model->newQuery()
            ->select('solicitudes.*')
            ->with(['detalles.item','usuarioAutoriza','usuarioAprueba','usuarioDespacha','estado','bitacoras'])
            ->delUsuarioCrea();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->ajax([
                'data' => "function(data) { formatDataDataTables($('#formFiltersDatatables').serializeArray(), data);   }"
            ])
            ->info(true)
            ->language(['url' => asset('js/SpanishDataTables.json')])
            ->responsive(true)
            ->orderBy(0,'desc')
            ->stateSave(true)
            ->dom('
                        <"row mb-2"
                            <"col-sm-12 col-md-6" B>
                            <"col-sm-12 col-md-6" f>
                        >
                        rt
                        <"row"
                            <"col-sm-6 order-2 order-sm-1" ip>
                            <"col-sm-6 order-1 order-sm-2 text-right" l>

                        >
                    ')
            ->buttons(

                Button::make('print')
                    ->text('<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'),
                Button::make('reset')
                    ->text('<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Reiniciar</span>'),
                Button::make('export')
                    ->text('<i class="fa fa-download"></i> <span class="d-none d-sm-inline">Exportar</span>'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('codigo'),
            Column::make('justificacion'),

            Column::make('fecha_solicita')
                ->name('fecha_solicita')
                ->data('fecha_solicita'),

//            Column::make('usuario_autoriza')
//                ->name('usuarioAutoriza.name')
//                ->data('usuario_autoriza.name'),

            Column::make('usuario_aprueba')
                ->name('usuarioAprueba.name')
                ->data('usuario_aprueba.name'),

            Column::make('usuario_despacha')
                ->name('usuarioDespacha.name')
                ->data('usuario_despacha.name'),


            Column::make('fecha_despacha')
                ->name('fecha_despacha')
                ->data('fecha_despacha'),

            Column::make('estado')
                ->name('estado.nombre')
                ->data('estado.nombre'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('15%')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'solicitudesdatatable_' . time();
    }
}
