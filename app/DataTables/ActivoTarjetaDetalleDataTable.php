<?php

namespace App\DataTables;

use App\Models\ActivoTarjetaDetalle;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivoTarjetaDetalleDataTable extends DataTable
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
            ->addColumn('action', function(ActivoTarjetaDetalle $activoTarjetaDetalle){

                 $id = $activoTarjetaDetalle->id;

                 return view('activo_tarjeta_detalles.datatables_actions',compact('activoTarjetaDetalle','id'))->render();
             })
             ->editColumn('id',function (ActivoTarjetaDetalle $activoTarjetaDetalle){

                 return $activoTarjetaDetalle->id;

                 //se debe crear la vista modal_detalles
                 //return view('activo_tarjeta_detalles.modal_detalles',compact('activoTarjetaDetalle'))->render();

             })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActivoTarjetaDetalle $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivoTarjetaDetalle $model)
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
            Column::make('tarjeta_id'),
            Column::make('activo_id'),
            Column::make('tipo'),
            Column::make('cantidad'),
            Column::make('valor'),
            Column::make('unidad_id'),
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
        return 'activo_tarjeta_detalles_'  . date('YmdHis');
    }
}
