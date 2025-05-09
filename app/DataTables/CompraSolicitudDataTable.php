<?php

namespace App\DataTables;

use App\Models\CompraSolicitud;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class CompraSolicitudDataTable extends DataTable
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
            ->addColumn('action', function(CompraSolicitud $compraSolicitud){
                $id = $compraSolicitud->id;
                return view('compra_solicitudes.datatables_actions',compact('compraSolicitud','id'));
            })
            ->editColumn('bodega.nombre',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->bodega->nombre ?? 'Principal';

            })
            ->editColumn('proveedor.nombre',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->proveedor->nombre ?? 'Sin Proveedor';

            })
            ->editColumn('estado.nombre',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->estado->nombre ?? 'Sin Estado';

            })
            ->editColumn('usuarioSolicita.name',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->usuarioSolicita->name ?? 'Sin Usuario';

            })
            ->editColumn('usuarioAprueba.name',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->usuarioAprueba->name ?? 'Sin Usuario';

            })
            ->editColumn('usuarioAdministra.name',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->usuarioAdministra->name ?? 'Sin Usuario';

            })
            ->editColumn('unidad.nombre',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->unidad->nombre ?? 'Sin Unidad';

            })
            ->editColumn('created_at',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->created_at->format('d/m/Y') ?? 'Sin Fecha';

            })
            ->editColumn('id',function (CompraSolicitud $compraSolicitud){

                return $compraSolicitud->id;

            })
            ->editColumn('justificacion',function (CompraSolicitud $compraSolicitud){

                return str($compraSolicitud->justificacion)->limit(50);

            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CompraSolicitud $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CompraSolicitud $model)
    {
        return $model->newQuery()->select($model->getTable().'.*')->with(
            'unidad',
            'proveedor',
            'estado',
            'usuarioSolicita',
            'usuarioAprueba',
            'usuarioAdministra'
        );
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
            Column::make('id')
                ->data('id')
                ->name('id')
                ->title('ID')
                ->width(50)
                ->addClass('text-center'),

            Column::make('unidad')
                ->data('unidad.nombre')
                ->name('unidad.nombre')
                ->title('Unidad'),


//            Column::make('proveedor_id')
//                ->data('proveedor.nombre')
//                ->name('proveedor.nombre')
//                ->title('Proveedor'),

            Column::make('codigo'),
            Column::make('fecha_requiere')
                ->data('created_at')
                ->name('created_at')
                ->title('Fecha Requiere'),

//
//            Column::make('justificacion')
//                ->data('justificacion')
//                ->name('justificacion')
//                ->title('Justificación'),

            Column::make('estado')
                ->data('estado.nombre')
                ->name('estado.nombre')
                ->title('Estado'),

            Column::make('usuario_solicita')
                ->data('usuarioSolicita.name')
                ->name('usuarioSolicita.name')
                ->title('Usuario Solicita'),

            Column::make('usuario_aprueba')
                ->data('usuarioAprueba.name')
                ->name('usuarioAprueba.name')
                ->title('Usuario Aprueba'),

            Column::make('usuario_administra')
                ->data('usuarioAdministra.name')
                ->name('usuarioAdministra.name')
                ->title('Usuario Administra'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('20%')
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'compra_solicitudes_datatable_' . time();
    }
}
