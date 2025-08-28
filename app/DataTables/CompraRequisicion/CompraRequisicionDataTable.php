<?php

namespace App\DataTables\CompraRequisicion;

use App\Models\CompraRequisicion\CompraRequisicion;
use Yajra\DataTables\EloquentDataTable;
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

        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', function (CompraRequisicion $compraRequisicion) {
                $id = $compraRequisicion->id;
                return view('compra_requisicions.autorizar.datatables_actions',
                    compact('compraRequisicion', 'id'));
            })
            ->editColumn('created_at', function (CompraRequisicion $compraRequisicion) {

                return $compraRequisicion->created_at->format('d/m/Y') ?? 'Sin Fecha';

            })
            ->editColumn('codigo',function (CompraRequisicion $compraRequisicion){
                return view('compra_requisicions.autorizar.modal_show_requisicion',compact('compraRequisicion'))->render();
            })
            ->rawColumns(['action', 'estado.nombre', 'codigo']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CompraRequisicion\CompraRequisicion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CompraRequisicion $model)
    {
        return $model->newQuery()->with([
            'unidad',
            'estado'
        ]);
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
            Column::make('unidad')
                ->data('unidad.nombre')
                ->name('unidad.nombre')
                ->title('Unidad'),

            Column::make('codigo_consolidacion')
                ->data('codigo_consolidacion')
                ->name('codigo_consolidacion')
                ->title('Código Consolidación'),

            Column::make('fecha_creacion')
                ->data('created_at')
                ->name('created_at')
                ->title('Fecha Creación'),

            Column::make('codigo'),

            Column::make('estado')
                ->data('estado.nombre')
                ->name('estado.nombre')
                ->title('Estado'),

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
