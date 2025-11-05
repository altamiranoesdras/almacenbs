@if($compra->tiene1h())
    <div class="btn-group">
        <button type="button"
                class="btn btn-outline-primary round dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <i class="fas fa-print"></i>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route('compras.h1.pdf',$compra->id) }}" target="_blank">
                    <i class="fas fa-file-pdf"></i> PreImpreso
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('compras.h1.pdf.digital',$compra->id) }}" target="_blank">
                    <i class="fas fa-file-alt"></i> Digital
                </a>
            </li>
        </ul>
    </div>
@endif

