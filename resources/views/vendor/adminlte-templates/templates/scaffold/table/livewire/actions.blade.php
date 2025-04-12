<div class='btn-group'>
    <a href="{{ $showUrl }}" class='btn btn-icon btn-flat-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ $editUrl }}" class='btn btn-icon btn-flat-secondary rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
    <a class='btn btn-icon btn-flat-danger rounded-circle' wire:click="deleteRecord({{ $recordId }})"
       onclick="confirm('Are you sure you want to remove this Record?') || event.stopImmediatePropagation()">
        <i class="fa fa-trash"></i>
    </a>
</div>
