<div class="form-group">
	@if($field['label'] == 'Description' || $field['label'] == 'Meta Description')
		<label for="inputEmail3" class="col-sm-3 control-label">{{ @$field['label'] }} <span class="text-danger">*</span></label>
	@else
		<label for="inputEmail3" class="col-sm-3 control-label">{{ @$field['label'] }}</label>
	@endif

	<div class="col-sm-6">
		<textarea name="{{ @$field['name'] }}" placeholder="{{ @$field['label'] }}" rows="3" class="form-control {{ @$field['class'] }}" {{ @$field['disabled']=='true'?'disabled':'' }}>{{ isset($_POST[$field['name']])?@$_POST[$field['name']]:@$field['value'] }}</textarea>
		<span class="text-danger">{{ $errors->first(@$field['name']) }}</span>
	</div>

	<div class="col-sm-3">
		<small>{{ $field['hint'] ?? "" }}</small>
	</div>
</div>