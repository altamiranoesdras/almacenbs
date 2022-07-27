<?php

namespace App\DataTables;

use App\Models\Compra;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompraDataTable extends DataTable
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
            ->addColumn('action', function(Compra $compra){

                 $id = $compra->id;

                 return view('compras.datatables_actions',compact('compra','id'))->render();
             })
             ->editColumn('id',function (Compra $compra){

                 return $compra->id;

                 //se debe crear la vista modal_detalles
                 //return view('compras.modal_detalles',compact('compra'))->render();

             })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Compra $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Compra $model)
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
            Column::make('tipo_id'),
            Column::make('proveedor_id'),
            Column::make('codigo'),
            Column::make('correlativo'),
            Column::make('fecha_documento'),
            Column::make('fecha_ingreso'),
            Column::make('serie'),
            Column::make('numero'),
            Column::make('estado_id'),
            Column::make('usuario_crea'),
            Column::make('usuario_recibe'),
            Column::make('observaciones'),
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
        return 'compras_'  . date('YmdHis');
    }
}
