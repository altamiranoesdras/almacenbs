<!-- 'bootstrap / Toggle Switch {{ $fieldTitle }} Field' -->
<div class="col-sm-6 mb-1">
    <div class="form-check custom-switch">
        @{!! Form::checkbox('{{ $fieldName }}', 1, null,  ['class' => 'form-check-input']) !!}
@if($config->options->localized)
        @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':', ['class' => 'form-check-label']) !!}
@else
        @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:', ['class' => 'form-check-label']) !!}
@endif
    </div>
</div>
