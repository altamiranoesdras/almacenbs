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
