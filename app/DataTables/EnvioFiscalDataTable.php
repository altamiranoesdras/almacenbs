<?php

namespace App\DataTables;

use App\Models\EnvioFiscal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EnvioFiscalDataTable extends DataTable
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
            ->addColumn('action', function(EnvioFiscal $envioFiscal){

                 $id = $envioFiscal->id;

                 return view('envio_fiscals.datatables_actions',compact('envioFiscal','id'))->render();
             })
             ->editColumn('id',function (EnvioFiscal $envioFiscal){

                 return $envioFiscal->id;

                 //se debe crear la vista modal_detalles
                 //return view('envio_fiscals.modal_detalles',compact('envioFiscal'))->render();

             })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EnvioFiscal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EnvioFiscal $model)
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
            Column::make('nuemero_constancia'),
            Column::make('serie_constancia'),
            Column::make('fecha'),
            Column::make('numero_cuenta'),
            Column::make('forma'),
            Column::make('correlativo_del'),
            Column::make('correlativo_al'),
            Column::make('cantidad'),
            Column::make('pendientes'),
            Column::make('serie'),
            Column::make('numero'),
            Column::make('libro'),
            Column::make('folio'),
            Column::make('resolucion'),
            Column::make('numero_gestion'),
            Column::make('fecha_gestion'),
            Column::make('correlativo'),
            Column::make('activo'),
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
        return 'envio_fiscals_'  . date('YmdHis');
    }
}
