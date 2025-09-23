<?php

namespace App\DataTables;

use App\Models\Compra;
use App\extensiones\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class CompraAprobarDataTable extends DataTable
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
            ->addColumn('action', function (Compra $compra){
                $id = $compra->id;

                return view('compras.aprobar.datatables_actions',compact('compra','id'));
            })
            ->addColumn('compra1h.folio',function (Compra $compra){
                return $compra->compra1h->folio ?? 'Sin 1H';
            })

            ->editColumn('id',function (Compra $compra){
                return view('compras.columna_id',compact('compra'));
            })

            ->editColumn('fecha_documento',function (Compra $compra){
                return fechaLtn($compra->fecha_documento);
            })

            ->editColumn('fecha_ingreso',function (Compra $compra){
                return fechaLtn($compra->fecha_ingreso);
            })
            ->editColumn('estado.nombre',function (Compra $compra){

                $color = $compra->color_estado;

                return "<span class='badge bg-{$color} fw-bold text-wrap' style='max-width: 200px;'>{$compra->estado->nombre}</span>";

            })

            ->editColumn('total',function (Compra $compra){
                return dvs().nfp($compra->total);
            })
            ->with([
                'totalFilter' => function() use ($dataTable){
                    return dvs().nfp($dataTable->results()->sum('total'));
                },
                'count_rows' => function() use ($dataTable){
                    return $dataTable->results()->count();
                }

            ])->rawColumns(['action','estado.nombre','id']);
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
            ->select('compras.*')
            ->noTemporal()
            ->with([
                'detalles' => function($q){
                    $q->with('item',function ($q){
                        $q->withoutAppends()
                            ->withTrashed();
                    });
                },
                'tipo',
                'usuarioCrea',
                'estado',
                'proveedor',
                'compra1h'
            ]);

//        $user = Auth::user();


        //Usuario normal o empleado solo las compras realizadas por el
//        if ($user->cannot('Ver todas las compras')){
//            $query->delUser($user->id);
//        }

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
            Column::make('id'),
            Column::make('h1')
                ->title('1H')
                ->data('compra1h.folio')
                ->name('compra1h.folio')
                ->searchable(false)
                ->orderable(false),
            Column::make('fecha_documento'),
            Column::make('fecha_ingreso'),
            Column::make('tipo')
                ->data('tipo.nombre')
                ->name('tipo.nombre'),
            Column::make('proveedor')
                ->data('proveedor.nombre')
                ->name('proveedor.nombre'),
            Column::make('estado')
                ->data('estado.nombre')
                ->name('estado.nombre'),
            Column::make('usuario')
                ->data('usuario_crea.name')
                ->name('usuarioCrea.name'),

//            Column::make('orden_compra')
//            ->data('orden_compra')
//            ->name('orden_compra'),
            Column::make('total')
            ->searchable(false)
            ->orderable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('15%')
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
        return 'reporte_compras_' . time();
    }
}
