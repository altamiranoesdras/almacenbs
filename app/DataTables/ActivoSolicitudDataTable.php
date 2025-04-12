<?php

namespace App\DataTables;

use App\Models\ActivoSolicitud;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivoSolicitudDataTable extends DataTable
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
            ->addColumn('action', function(ActivoSolicitud $activoSolicitud){

                 $id = $activoSolicitud->id;

                 return view('activo_solicituds.datatables_actions',compact('activoSolicitud','id'))->render();
             })
            ->editColumn('id',function (ActivoSolicitud $activoSolicitud){

                 return $activoSolicitud->id;

                 //se debe crear la vista modal_detalles
                 //return view('activo_solicituds.modal_detalles',compact('activoSolicitud'))->render();

             })
            ->editColumn('colaborador_origen', function (ActivoSolicitud $activoSolicitud) {
                return $activoSolicitud->colaboradorOrigen->nombres ?? '';
            })
            ->editColumn('unidad_origen', function (ActivoSolicitud $activoSolicitud) {
                return $activoSolicitud->unidadOrigen->nombre ?? '';
            })
            ->editColumn('colaborador_destino', function (ActivoSolicitud $activoSolicitud) {
                return $activoSolicitud->colaboradorOrigen->nombres ?? '';
            })
            ->editColumn('unidad_destino', function (ActivoSolicitud $activoSolicitud) {
                return $activoSolicitud->unidadDestino->nombre ?? '';
            })
            ->editColumn('usuario_autoriza', function (ActivoSolicitud $activoSolicitud) {
                return $activoSolicitud->usuarioAutoriza->name ?? '';
            })
            ->editColumn('usuario_inventario', function (ActivoSolicitud $activoSolicitud) {
                return $activoSolicitud->usuarioInventario->name ?? '';
            })
            ->editColumn('estado', function (ActivoSolicitud $activoSolicitud) {
                return $activoSolicitud->estado->nombre ?? '';
            })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActivoSolicitud $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivoSolicitud $model)
    {
        return $model->newQuery();
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
                    ->orderBy(1,'desc')
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
            Column::make('colaborador_origen'),
            Column::make('unidad_origen'),
            Column::make('colaborador_destino'),
            Column::make('unidad_destino'),
            Column::make('usuario_autoriza'),
            Column::make('usuario_inventario'),
            Column::make('observaciones'),
            Column::make('estado'),
            Column::computed('action')
                            ->exportable(false)
                            ->printable(false)
                            ->width('20%')
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
        return 'activo_solicituds_'  . date('YmdHis');
    }
}
