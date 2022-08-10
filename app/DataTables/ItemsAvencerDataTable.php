<?php

namespace App\DataTables;

use App\Models\Stock;
use Carbon\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ItemsAvencerDataTable extends DataTable
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
            ->editColumn('fecha_vence',function (Stock $stock){
                return fecha($stock->fecha_vence);
            })
            ->editColumn('quedan',function (Stock $stock){
                $hoy = Carbon::now();
                $fechaVen = Carbon::parse($stock->fecha_vence);
                $dif = $fechaVen->diffForHumans($hoy,false);
                return str_replace('después','',$dif);
            })
            ->setRowClass(function (Stock $stock) {

                $hoy = Carbon::now();
                $fechaVen = Carbon::parse($stock->fecha_vence);

                return $fechaVen < $hoy  ? 'bg-danger' : 'bg-warning';

            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Stock $model)
    {
        return $model->newQuery()->orderBy('fecha_vence')->with(['item']);
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
            ->ajax([
                'data' => "function(data) { formatDataDataTables($('#form-filter-items-vencen').serializeArray(), data);   }"
            ])
            ->parameters([
                'dom'     => 'Bfltrip',
                'order'   => [],
                'language' => ['url' => asset('js/SpanishDataTables.json')],
                //'scrollX' => false,
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
            'id',
            'Artículo' => ['data' => 'item.nombre','name' => 'item.nombre'],
            'Stock' => ['data' => 'cantidad','name' => 'cantidad'],
            'Fecha Vence' => ['data' => 'fecha_vence','name' => 'fecha_vence'],
            'Le Quedan' => ['data' => 'quedan','searchable' => false],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'itemsdatatable_' . time();
    }
}
