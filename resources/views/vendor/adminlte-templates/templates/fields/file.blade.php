<!-- {{ $fieldTitle }} Field -->
<div class="col-sm-6 mb-1">
@if($config->options->localized)
    @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':') !!}
@else
    @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:') !!}
@endif
    <div class="input-group">
        <div class="custom-file">
            @{!! Form::file('{{ $fieldName }}', ['class' => 'custom-file-input']) !!}
            @{!! Form::label('{{ $fieldName }}', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
