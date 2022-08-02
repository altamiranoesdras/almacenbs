<?php

namespace App\DataTables;

use App\Models\Solicitud;
use App\extensiones\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SolicitudeUserDataTable extends DataTable
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

        return $dataTable->addColumn('action', function ($solicitud){
                $id = $solicitud->id;
                return view('solicitudes.datatables_actions_user',compact('solicitud','id'))->render();
            })
            ->editColumn('usuario_despacha',function ($solicitud){
                return $solicitud->userDespacha->name ?? null;
            })
            ->editColumn('codigo',function ($solicitud){
                return view('solicitudes.modal_show',compact('solicitud'))->render();
            })
            ->editColumn('observaciones',function ($solicitud){
                return str_limit($solicitud->observaciones,30);
            })
            ->editColumn('fecha_solicita',function ($solicitud){
                return $solicitud->fecha_solicita->format('d/m/Y H:i:s');
            })
            ->editColumn('fecha_despacha',function ($solicitud){
                if ($solicitud->fecha_despacha){
                    return $solicitud->fecha_despacha->format('d/m/Y H:i:s');
                }
            })
            ->rawColumns(['action','codigo']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Solicitud $model)
    {

        return $model->newQuery()->with(['detalles.item','userSolicita','userDespacha','estado'])->delUser();
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
                'responsive' => true,
                'buttons' => [
//                    ['extend' => 'create', 'text' => '<i class="fa fa-plus"></i> <span class="d-none d-sm-inline">Crear</span>'],
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
            'codigo' => ['name' => 'correlativo', 'data' => 'codigo'],
            'observaciones',
            'usuario_solicita' => ['data' => 'user_solicita.name','name' => 'userSolicita.name'],
            'fecha_solicita',
            'usuario_despacha' => ['name'=>'userDespacha.name'],
            'fecha_despacha',
            'estado' => ['data' => 'estado.nombre','name.estado.nombre']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'solicitudesdatatable_' . time();
    }
}
