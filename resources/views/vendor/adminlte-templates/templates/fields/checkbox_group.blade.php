<!-- {{ $fieldTitle }} Field -->
<div class="col-sm-12 mb-1">
@if($config->options->localized)
    @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':') !!}
@else
    @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:') !!}
@endif
@if($config->options->localized)
    @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':') !!}
@else
    @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:') !!}
@endif
    {!! $checkboxes !!}
</div>
