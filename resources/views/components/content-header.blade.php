<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">
                    {{ $titulo }}
                </h2>
            </div>
        </div>
    </div>

    @if (trim($slot))
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>
