<?php

namespace App\DataTables;

use App\Models\Activo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivoDataTable extends DataTable
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
            ->addColumn('action', function(Activo $activo){

                 $id = $activo->id;

                 return view('activos.datatables_actions',compact('activo','id'))->render();
             })
             ->editColumn('id',function (Activo $activo){

                 return $activo->id;

                 //se debe crear la vista modal_detalles
                 //return view('activos.modal_detalles',compact('activo'))->render();

             })
            ->editColumn('valor',function (Activo $activo){
                return dvs().nfp($activo->valor);
            })
            ->editColumn('fecha_registro',function (Activo $activo){
                return fechaLtn($activo->fecha_registro);
            })
            ->editColumn('imagen',function (Activo $activo){
                return "<img src='$activo->thumb' alt=\"\" class=\"img-responsive \" width='42' height='42'>";
            })
            ->rawColumns(['action','id','imagen']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Activo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Activo $model)
    {
        return $model->newQuery()
            ->select($model->getTable().".*")
            ->with(['tipo','estado','renglon']);
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
                        ->text('<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Refrescar</span>'),

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
            Column::make('imagen')
                ->searchable(false)
                ->orderable(false)
                ->exportable(false),
            Column::make('descripcion'),
            Column::make('codigo_inventario'),
            Column::make('codigo_sicoin'),
            Column::make('folio'),
            Column::make('valor_actual'),
            Column::make('fecha_registro'),
            Column::make('tipo')->data('tipo.nombre')->name('tipo.nombre'),
            Column::make('estado')->data('estado.nombre')->name('estado.nombre'),
            Column::make('renglon')->data('renglon.numero')->name('renglon.numero'),
            Column::make('nit'),
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
        return 'activos_'  . date('YmdHis');
    }
}
