<?php

namespace App\DataTables;

use App\Models\ItemTraslado;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ItemTrasladoDataTable extends DataTable
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
            ->addColumn('action', function(ItemTraslado $itemTraslado){

                 $id = $itemTraslado->id;

                 return view('item_traslados.datatables_actions',compact('itemTraslado','id'))->render();
             })
             ->editColumn('id',function (ItemTraslado $itemTraslado){

                 return $itemTraslado->id;

                 //se debe crear la vista modal_detalles
                 //return view('item_traslados.modal_detalles',compact('itemTraslado'))->render();

             })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ItemTraslado $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ItemTraslado $model)
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
            Column::make('correlativo'),
            Column::make('item_origen'),
            Column::make('cantidad_origen'),
            Column::make('item_destino'),
            Column::make('cantidad_destino'),
            Column::make('observaciones'),
            Column::make('user_id'),
            Column::make('estado_id'),
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
    protected function filename()
    {
        return 'item_traslados_'  . date('YmdHis');
    }
}
