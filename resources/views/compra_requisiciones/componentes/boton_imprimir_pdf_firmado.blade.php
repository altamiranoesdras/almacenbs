@if($compraRequisicion->tienePdfFirmado())
    <button type="button" class="btn btn-icon btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#modalShowPdfFirmado{{$compraRequisicion->id}}">
        <i class="fa fa-print"></i>
    </button>

    <!-- Modal -->

    <div class="modal fade" id="modalShowPdfFirmado{{$compraRequisicion->id}}" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- modal-xl para que sea grande -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Vista previa del PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="{!! route('compra.requisiciones.pdf.firmado',$compraRequisicion->id) !!}" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

