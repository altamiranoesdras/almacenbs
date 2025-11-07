<?php

namespace App\DataTables;

use App\Models\Consumo;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ConsumoUserDataTable extends DataTable
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
            ->addColumn('action', function(Consumo $consumo){

                 $id = $consumo->id;

                 return view('consumos.datatables_actions',compact('consumo','id'))->render();
             })
             ->editColumn('id',function (Consumo $consumo){

                 return $consumo->id;

                 //se debe crear la vista modal_detalles
                 //return view('consumos.modal_detalles',compact('consumo'))->render();

             })
             ->editColumn('created_at',function (Consumo $consumo){

                 return fechaLtn($consumo->created_at);


             })
                ->editColumn('fecha_procesa',function (Consumo $consumo){

                    return fechaLtn($consumo->fecha_procesa);
                })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Consumo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Consumo $model)
    {

        /**
         * @var User
         */
        $usuario = auth()->user();

        return $model->newQuery()
            ->select($model->getTable().".*")
            ->where('usuario_crea',$usuario->id)
            ->noTemporal()
            ->with([
                'usuarioCrea',
                'unidad',
                'bodega',
                'estado',
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
            Column::make('codigo'),
            Column::make('fecha_crea')->name('created_at')->data('created_at'),
            Column::make('fecha_procesa')->name('fecha_procesa')->data('fecha_procesa'),
            Column::make('unidad')->name('unidad.nombre')->data('unidad.nombre'),
            Column::make('CAJ')->name('bodega.nombre')->data('bodega.nombre'),
            Column::make('estado')->name('estado.nombre')->data('estado.nombre'),
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
        return 'consumos_'  . date('YmdHis');
    }
}
