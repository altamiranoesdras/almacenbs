<?php


namespace App\DataTables\SolicitudesCompra;

use App\Models\CompraSolicitud;
use App\Models\Solicitud;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SolicitudCompraUnificarTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', function (CompraSolicitud $compraSolicitud) {
                $id = $compraSolicitud->id;
                return view('compra_solicitudes.consolidar.datatables_actions', compact('compraSolicitud', 'id'));
            })
            ->addColumn('checkbox', function (CompraSolicitud $compraSolicitud) {
                $id = $compraSolicitud->id;
                return view('compra_solicitudes.mis_solicitudes.checkbox', compact('id'));
            })
            ->editColumn('unidad.nombre', function (CompraSolicitud $compraSolicitud) {

                return $compraSolicitud->unidad->nombre_con_padre ?? 'Sin Unidad';

            })
            ->editColumn('fecha_solicita', function (CompraSolicitud $compraSolicitud) {
                return fechaLtn($compraSolicitud->fecha_solicita);
            })
            ->editColumn('estado.nombre', function (CompraSolicitud $solicitud) {

                $color = $solicitud->estado->color;

                return "<span class='badge badge-light-$color'>{$solicitud->estado->nombre}</span>";

            })
            ->editColumn('usuarioSolicita.name', function (CompraSolicitud $compraSolicitud) {

                return $compraSolicitud->usuarioSolicita->name ?? 'Sin Usuario';

            })
            ->editColumn('codigo',function (CompraSolicitud $solicitud){
                return view('compra_solicitudes.consolidar.modal_show_solicitud',compact('solicitud'))->render();
            })
            ->rawColumns(['action', 'checkbox', 'estado.nombre', 'codigo']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\CompraSolicitud  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CompraSolicitud $model)
    {
        return $model->newQuery()
            ->select($model->getTable().'.*')
            ->noTemporal()
            ->with(
                'unidad',
                'estado',
                'usuarioSolicita',
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
            ->orderBy(1, 'desc')
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

                Button::make()
                    ->text('<i class="fa fa-check"></i> Consolidar')
                    ->addClass('btn btn-outline-success btnConsolidar')
                    ->attr(['id' => 'btnConsolidar'])
                    ->action('function(e, dt, node, config) {
                        consolidarSolicitudes();
                    }'),
                Button::make('reset')
                    ->addClass('btn btn-outline-secondary')
                    ->text('<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Refrescar</span>'),

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
            Column::computed('checkbox')
                ->title('Ha Consolidar')
                ->exportable(false)
                ->printable(false)
                ->width('20%')
                ->addClass('text-center'),

            Column::make('codigo'),

            Column::make('unidad')
                ->data('unidad.nombre')
                ->name('unidad.nombre')
                ->title('Unidad'),

            Column::make('fecha_solicita')
                ->data('fecha_solicita')
                ->title('Fecha Solicita'),

            Column::make('estado')
                ->data('estado.nombre')
                ->name('estado.nombre')
                ->title('Estado'),

            Column::make('usuario_solicita')
                ->data('usuarioSolicita.name')
                ->name('usuarioSolicita.name')
                ->title('Usuario Solicita'),

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
        return 'compra_solicitudes_datatable_'.time();
    }
}
