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
                ->stateSave(false)
                ->orderBy(1,'desc')
                ->dom('
                    <"card-header border-bottom p-1"
                        <"head-label">
                        <"dt-action-buttons text-start" B>
                    >
                    <"d-flex justify-content-between align-items-center mx-0 row"
                        <"col-sm-12 col-md-6" l>
                        <"col-sm-12 col-md-6" f>
                    >
                    t
                    <"d-flex justify-content-between mx-0 row"
                        <"col-sm-12 col-md-6" i>
                        <"col-sm-12 col-md-6" p>
                    o>
                ')
                ->buttons(


                    Button::make('reset')
                        ->addClass('btn btn-outline-secondary')
                        ->text('<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Reiniciar</span>'),

                    Button::make('export')
                        ->extend('collection')
                        ->addClass('dt-button buttons-collection btn btn-outline-secondary dropdown-toggle me-2')
                        ->text('<i class="fa fa-download"></i> <span class="d-none d-sm-inline">Exportar</span>')
                        ->buttons([
                            Button::make('print')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-print"></i> <span class="d-none d-sm-inline"> Imprimir</span>'),
                            Button::make('csv')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-csv"></i> <span class="d-none d-sm-inline"> Csv</span>'),
                            Button::make('pdf')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-pdf"></i> <span class="d-none d-sm-inline"> Pdf</span>'),
                            Button::make('excel')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline"> Excel</span>'),
                        ]),
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
