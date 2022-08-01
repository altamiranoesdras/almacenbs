<?php

namespace App\DataTables;

use App\Models\Solicitud;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SolicitudDataTable extends DataTable
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
            ->addColumn('action', function(Solicitud $solicitud){

                 $id = $solicitud->id;

                 return view('solicitudes.datatables_actions',compact('solicitud','id'))->render();
             })
             ->editColumn('id',function (Solicitud $solicitud){

                 return $solicitud->id;

                 //se debe crear la vista modal_detalles
                 //return view('solicitudes.modal_detalles',compact('solicitud'))->render();

             })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Solicitud $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Solicitud $model)
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
            Column::make('justificacion'),
            Column::make('unidad_id'),
            Column::make('usuario_crea'),
            Column::make('usuario_solicita'),
            Column::make('usuario_autoriza'),
            Column::make('usuario_aprueba'),
            Column::make('usuario_despacha'),
            Column::make('firma_requiere'),
            Column::make('firma_autoriza'),
            Column::make('firma_aprueba'),
            Column::make('firma_almacen'),
            Column::make('fecha_solicita'),
            Column::make('fecha_autoriza'),
            Column::make('fecha_aprueba'),
            Column::make('fecha_almacen_firma'),
            Column::make('fecha_informa'),
            Column::make('fecha_despacha'),
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
        return 'solicituds_'  . date('YmdHis');
    }
}
