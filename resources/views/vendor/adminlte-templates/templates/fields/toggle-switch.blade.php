<!-- 'bootstrap / Toggle Switch {{ $fieldTitle }} Field' -->
<div class="col-sm-6 mb-1">
    <div class="custom-control custom-switch">
        @{!! Form::checkbox('{{ $fieldName }}', 1, null,  ['class' => 'custom-control-input']) !!}
@if($config->options->localized)
        @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':', ['class' => 'custom-control-label']) !!}
@else
        @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:', ['class' => 'custom-control-label']) !!}
@endif
    </div>
</div>
