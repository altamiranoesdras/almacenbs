<?php

namespace App\DataTables;

use App\Models\Item;
use App\extensiones\DataTable;
use App\VistaItem;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

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
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', function ($item){
                return view('items.datatables_actions',compact('item'))->render();
            })
            ->editColumn('marca_nombre', function ($item){
                return $item->marca->nombre ?? 'Sin marca';
            })
            ->editColumn('unimed_nombre', function ($item){
                return $item->unimed->nombre ?? 'Sin U/M';
            })
            ->editColumn('precio_venta',function ($data){
                return nfp($data->precio_venta);

            })
            ->editColumn('precio_compra',function ($data){
                return nfp($data->precio_compra);

            })
            ->editColumn('stock',function ($item){
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
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Item $model)
    {
        return $model->newQuery()->with(['stocks']);
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
            ->addAction(['width' => '15%','printable' => false, 'title' => 'Acción'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'language' => ['url' => asset('js/SpanishDataTables.json')],
                //'scrollX' => false,
                'stateSave' => true,
                'responsive' => true,
                'buttons' => [
                    ['extend' => 'create', 'text' => '<i class="fa fa-plus"></i> <span class="d-none d-sm-inline">Crear</span>'],
                    ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'],
                    ['extend' => 'reload', 'text' => '<i class="fa fa-sync-alt"></i> <span class="d-none d-sm-inline">Recargar</span>'],
                    ['extend' => 'reset', 'text' => '<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Reiniciar</span>'],
                    ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> <span class="d-none d-sm-inline">Exportar</span>'],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
//            'imagen' ,
            Column::make('código')->name('codigo')->data('codigo'),
            Column::make('nombre')->name('nombre')->data('nombre'),
            Column::make('precio_v')->name('precio_venta')->data('precio_venta'),
            Column::make('marca')->name('marca.nombre')->data('marca_nombre'),
            Column::make('U/M')->name('unimed.nombre')->data('unimed_nombre'),
            Column::make('stock')->searchable(false),
            Column::make('ubicación')->name('ubicacion')->data('ubicacion'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'itemsdatatable_' . time();
    }
}
