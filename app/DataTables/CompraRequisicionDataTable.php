<?php

namespace App\DataTables;

use App\Models\CompraRequisicion\CompraRequisicion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompraRequisicionDataTable extends DataTable
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
            ->addColumn('action', function(CompraRequisicion $compraRequisicion){
                $id = $compraRequisicion->id;
                return view('compra_requisicions.datatables_actions',compact('compraRequisicion','id'));
            })
            ->editColumn('id',function (CompraRequisicion $compraRequisicion){

                return $compraRequisicion->id;

            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CompraRequisicion\CompraRequisicion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CompraRequisicion $model)
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
            Column::make('tipo_concurso_id'),
            Column::make('ipo_adquisicion_id'),
            Column::make('correlativo'),
            Column::make('codigo'),
            Column::make('codigo_consolidacion'),
            Column::make('npg'),
            Column::make('nog'),
            Column::make('proveedor_adjudicado'),
            Column::make('numero_adjudicacion'),
            Column::make('estado_id'),
            Column::make('subproductos'),
            Column::make('partidas'),
            Column::make('observaciones'),
            Column::make('justificacion'),
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
        return 'compra_requisicions_datatable_' . time();
    }
}
