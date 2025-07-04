<li class="nav-item d-none d-lg-block" wire:click="changeMode" wire:ignore>
    <a class="nav-link nav-link-style">
        <i class="ficon" data-feather="{{ $theme->value == 'light-layout' ? 'moon' : 'sun'}}"></i>
    </a>
</li>