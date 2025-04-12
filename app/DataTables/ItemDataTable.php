<?php

namespace App\DataTables;

use App\Models\Item;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ItemDataTable extends DataTable
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
            ->addColumn('action', function(Item $item){

                 $id = $item->id;

                 return view('items.datatables_actions',compact('item','id'))->render();
            })
            ->editColumn('precio_compra',function ($data){
                return dvs().' '.nfp($data->precio_compra);

            })
            ->editColumn('marca.nombre',function (Item $item){
                return $item->marca->nombre ?? '';
            })
            ->editColumn('unimed.nombre',function (Item $item){
                return $item->unimed->nombre ?? '';
            })
            ->editColumn('stock',function (Item $item){
                return $item->stocks->sum('cantidad');
            })
            ->editColumn('imagen',function (Item $item){
                return "<img src='$item->thumb' alt=\"\" class=\"img-responsive \" width='42' height='42'>";
            })
            ->rawColumns(['imagen','stock','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Item $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Item $model)
    {
        return $model->newQuery()->select('items.*')->with(['presentacion','stocks','renglon','marca','unimed']);
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
            Column::make('imagen')->searchable(false)->orderable(false),
//            Column::make('codigo'),
            Column::make('codigo_insumo'),
            Column::make('codigo_presentacion'),
            Column::make('nombre'),
            Column::make('renglon')->name('renglon.numero')->data('renglon.numero'),
            Column::make('renglon_descripcion')
                ->name('renglon.descripcion')
                ->data('renglon.descripcion')
                ->visible(false)
                ->exportable(false),
//            Column::make('presentacion')->name('presentacion.nombre')->data('presentacion.nombre'),
            Column::make('U/M')->name('unimed.nombre')->data('unimed.nombre'),
            Column::make('stock')->searchable(false)->orderable(false),
            Column::make('precio_compra'),
//            Column::make('ubicacion'),
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
        return 'items_'  . date('YmdHis');
    }
}
