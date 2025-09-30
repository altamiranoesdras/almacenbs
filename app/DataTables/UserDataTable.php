<?php

namespace App\DataTables;

use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('action', function($User){
                $id = $User->id;
                return view('admin.users.datatables_actions',compact('User','id'));
            })
            ->editColumn('name',function (User $user){

                return view('admin.users.columna_nombre',compact('user'));

            })
            //puesto
                ->editColumn('puesto.nombre',function (User $user){
                    return $user->puesto->nombre ?? 'Sin puesto';
                })
            ->editColumn('unidad.nombre',function (User $user){
                return $user->unidad->nombre_con_padre ?? 'Sin unidad';
            })
            ->editColumn('roles',function (User $user){

                return view('admin.users.partials.roles',compact('user'));

            })
            ->rawColumns(['action','nombre','roles']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = $model->newQuery()
            ->select($model->getTable().'.*')
            ->with(['roles','media','unidad','puesto','bodega']);

        //si el usuario no puede ver a todos los usuarios
        if (auth()->user()->cannot('ver todos los usuarios')){

            //excluir los roles dev y super
            $query->whereDoesntHave('roles',function ($q){
                $q->whereIn('id',[Role::DEVELOPER,Role::SUPERADMIN]);
            });
        }

        return $query;
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

            Column::make('nombre')->name('name')->data('name'),
            Column::make('id'),
            Column::make('username'),
            Column::make('email'),
            Column::make('puesto_id')->data('puesto.nombre')->name('puesto.nombre')->title('Puesto'),
            Column::make('unidad_id')->data('unidad.nombre')->name('unidad.nombre')->title('Unidad'),
            Column::make('bodega_id')->data('bodega.nombre')->name('bodega.nombre')->title('Bodega'),
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
        return 'UserDataTable2_' . date('YmdHis');
    }
}
