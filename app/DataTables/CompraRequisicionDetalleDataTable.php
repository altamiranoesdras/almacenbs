<?php

namespace App\DataTables;

use App\Models\CompraRequisicionDetalle;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class CompraRequisicionDetalleDataTable extends DataTable
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
            ->addColumn('action', function(CompraRequisicionDetalle $compraRequisicionDetalle){
                $id = $compraRequisicionDetalle->id;
                return view('compra_requisicion_detalles.datatables_actions',compact('compraRequisicionDetalle','id'));
            })
            ->editColumn('id',function (CompraRequisicionDetalle $compraRequisicionDetalle){

                return $compraRequisicionDetalle->id;

            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CompraRequisicionDetalle $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CompraRequisicionDetalle $model)
    {
        return $model->newQuery()->select($model->getTable().'.*');
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
            Column::make('requisicion_id'),
            Column::make('solicitud_detalle_id'),
            Column::make('item_id'),
            Column::make('cantidad'),
            Column::make('precio_estimado'),
            Column::make('observaciones'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('20%')
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'compra_requisicion_detalles_datatable_' . time();
    }
}
