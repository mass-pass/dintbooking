<div class="form-group {{ $field['id'] ?? $field['name']}}">
	@if($field['label'] == 'Subheading' || $field['class'] == 'not-require')
		<label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] ?? ''}}</label>
	@else
		<label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] ?? ''}} <span class="text-danger">*</span></label>
	@endif
	<div class="col-sm-6">
		<input type="text" name="{{ $field['name'] ?? '' }}" class="form-control {{ $field['class'] ?? ''}}" id="{{ $field['id'] ?? $field['name'] }}" value="{{ isset($_POST[$field['name']])?@$_POST[$field['name']]:@$field['value'] }}" placeholder="{{ @$field['label'] }}" {{ isset($field['readonly']) && $field['readonly']=='true'?'readonly':'' }}>
		<span class="text-danger">{{ $errors->first($field['name']) }}</span>
	</div>
	<div class="col-sm-3">
		<small>{{ $field['hint'] ?? "" }}</small>
	</div>
</div>