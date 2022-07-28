<?php

namespace App\DataTables;

use App\Models\CompraEstado;
use App\Models\Compra;
use App\Models\VistaCompra;
use App\extensiones\DataTable;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;

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
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', function ($compra){
                $id = $compra->id;

                return view('compras.datatables_actions',compact('compra','id'));
            })
            ->editColumn('fecha',function ($compra){
                return fecha($compra->fecha);
            })
            ->editColumn('fecha_ingreso_plan',function ($compra){
                return fecha($compra->fecha);
            })
            ->editColumn('fecha_ingreso',function ($compra){
                return fecha($compra->fecha);
            })

            ->editColumn('total',function ($compra){
                return dvs().nfp($compra->total);
            })
            ->setRowClass(function ($data) {

                $alert = '';

                if(hoyDb()>$data->fecha_ingreso_plan && $data->estado->id == CompraEstado::CREADA ){
                    $alert = 'alert-danger';
                }
                elseif(hoyDb() == $data->fecha_ingreso_plan  && $data->estado->id == CompraEstado::CREADA ){
                    $alert = 'alert-warning';
                }

                return $alert;

            })
            ->with([
                'totalFilter' => function() use ($dataTable){
                    return dvs().nfp($dataTable->results()->sum('total'));
                },
                'count_rows' => function() use ($dataTable){
                    return $dataTable->results()->count();
                }

            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Compra $model)
    {

        $query = $model->newQuery()
            ->noTemporal()
            ->with(['detalles.item','tipo','usuarioCrea','estado','proveedor']);

        $user = Auth::user();


        //Usuario normal o empleado solo las compras realizadas por el
        if ($user->cannot('ver todas las compras')){
            $query->delUser($user->id);
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
                'data' => "function(data) { formatDataDataTables($('#form-filter-compras').serializeArray(), data);   }"
            ])
            ->addAction(['width' => '10%','printable' => false, 'title' => 'Acción'])
            ->responsive(true)
            ->parameters([
                'dom'     => 'Bflrtip',
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
            'id' => ['name' => 'id', 'data' => 'id'],
            'codigo' => ['name' => 'correlativo', 'data' => 'codigo'],
//            'creada' => ['name' => 'creada', 'data' => 'creada'],
//            'hora' => ['name' => 'hora', 'data' => 'hora'],
//            'fecha_doc' => ['name' => 'fecha', 'data' => 'fecha'],
            'fecha_a_ingresar' => ['name' => 'fecha_ingreso_plan', 'data' => 'fecha_ingreso_plan'],
            'fecha_recibió' => ['name' => 'fecha_ingreso', 'data' => 'fecha_ingreso'],
////            'fecha_pago' => ['name' => 'fecha_credito', 'data' => 'fecha_credito'],
            'tipo' => ['name' => 'tipo.nombre', 'data' => 'tipo.nombre'],
            'proveedor' => ['name' => 'proveedor.nombre', 'data' => 'proveedor.nombre'],
            'total' => ['name' => 'total', 'data' => 'total','searchable' => false],
            'estado' => ['name' => 'estado.descripcion', 'data' => 'estado.nombre'],
            'usuario' => ['name' => 'usuarioCrea.name', 'data' => 'usuario_crea.name', ],
//            'bodega' => ['name' => 'tienda.nombre', 'data' => 'tienda.nombre', ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'reporte_compras_' . time();
    }
}
