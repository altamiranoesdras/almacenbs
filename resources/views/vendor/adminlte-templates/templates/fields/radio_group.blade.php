<!-- {{ $fieldTitle }} Field -->
<div class="col-sm-12 mb-1">
@if($config->options->localized)
    @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}'), ['class' => 'form-check-label']) !!}
@else
    @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}', ['class' => 'form-check-label']) !!}
@endif
    {!! $radioButtons !!}
</div>
