<?php

namespace App\DataTables;

use App\Models\Colaborador;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ColaboradorDataTable extends DataTable
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
            ->addColumn('action', function(Colaborador $colaborador){

                 $id = $colaborador->id;

                 return view('colaboradores.datatables_actions',compact('colaborador','id'))->render();
             })
             ->editColumn('id',function (Colaborador $colaborador){

                 return $colaborador->id;


             })
             ->editColumn('puesto.nombre',function (Colaborador $colaborador){

                 return $colaborador->puesto->nombre ?? '';


             })
             ->editColumn('unidad.nombre',function (Colaborador $colaborador){

                 return $colaborador->unidad->nombre ?? '';


             })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Colaborador $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Colaborador $model)
    {
        return $model->newQuery()
            ->select($model->getTable().".*")
            ->with(['unidad','puesto']);
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
            Column::make('nombres'),
            Column::make('apellidos'),
            Column::make('dpi'),
            Column::make('correo'),
            Column::make('telefono'),
            Column::make('direccion'),
            Column::make('nit'),
            Column::make('puesto')->name('puesto.nombre')->data('puesto.nombre'),
            Column::make('unidad')->name('unidad.nombre')->data('unidad.nombre'),
//            Column::make('user_id'),
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
        return 'colaboradores_'  . date('YmdHis');
    }
}
