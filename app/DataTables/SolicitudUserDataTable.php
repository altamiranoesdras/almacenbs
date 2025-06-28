<?php

namespace App\DataTables;

use App\Models\Solicitud;
use App\extensiones\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class SolicitudUserDataTable extends DataTable
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
            ->addColumn('action', function(Solicitud $solicitud){

                $id = $solicitud->id;

                return view('solicitudes.usuario.datatables_actions',compact('solicitud','id'));

            })
            ->editColumn('usuario_despacha',function (Solicitud $solicitud){
                return $solicitud->usuarioSolicita->name ?? null;
            })
            ->editColumn('codigo',function (Solicitud $solicitud){

                return view('solicitudes.modal_show',compact('solicitud'))->render();

            })
            ->editColumn('justificacion',function (Solicitud $solicitud){

                return str_limit($solicitud->justificacion,30);

            })
            ->editColumn('usuario_autoriza.name',function (Solicitud $solicitud){

                return $solicitud->usuarioAutoriza->name ?? '';

            })
            ->editColumn('usuario_aprueba.name',function (Solicitud $solicitud){

                return $solicitud->usuarioAprueba->name ?? '';

            })
            ->editColumn('usuario_despacha.name',function (Solicitud $solicitud){

                return $solicitud->usuarioDespacha->name ?? '';

            })
            ->editColumn('fecha_solicita',function (Solicitud $solicitud){

                return fechaHoraLtn($solicitud->fecha_solicita);

            })
            ->editColumn('estado.nombre',function (Solicitud $solicitud){

                $color = $solicitud->estado->color;

                return "<span class='badge badge-$color'>{$solicitud->estado->nombre}</span>";

            })
            ->editColumn('fecha_despacha',function (Solicitud $solicitud){

                return fechaHoraLtn($solicitud->fecha_despacha);

            })
            ->rawColumns(['action','codigo','estado.nombre']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Solicitud $model)
    {

        return $model->newQuery()
            ->select('solicitudes.*')
            ->with([
                'detalles.item' => function ($query) {
                    $query->withoutAppends();
                },
                'usuarioAutoriza',
                'usuarioAprueba',
                'usuarioDespacha',
                'estado',
                'bitacoras'
            ])
            ->delUsuarioCrea();
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
            Column::make('codigo'),
            Column::make('justificacion'),

            Column::make('fecha_solicita')
                ->name('fecha_solicita')
                ->data('fecha_solicita'),

//            Column::make('usuario_autoriza')
//                ->name('usuarioAutoriza.name')
//                ->data('usuario_autoriza.name'),

            Column::make('usuario_aprueba')
                ->name('usuarioAprueba.name')
                ->data('usuario_aprueba.name'),

            Column::make('usuario_despacha')
                ->name('usuarioDespacha.name')
                ->data('usuario_despacha.name'),


            Column::make('fecha_despacha')
                ->name('fecha_despacha')
                ->data('fecha_despacha'),

            Column::make('estado')
                ->name('estado.nombre')
                ->data('estado.nombre'),

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
        return 'solicitudesdatatable_' . time();
    }
}
