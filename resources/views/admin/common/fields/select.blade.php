<div class="form-group {{ $field['id'] ?? $field['name']}}">
<label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] ?? ''}}</label>
	<div class="col-sm-6">
		<select class="form-control {{ $field['class'] ?? '' }}" id="{{ $field['id'] ?? $field['name']}}" name="{{ $field['name'] }}">
			@foreach ($field['options'] as $value => $name)
				<option value='{{ $value }}' {{ (@$_POST[$field['name']] == $value || @$field['value'] ==  @$value)?'selected':'' }}>{{ $name }}</option>
			@endforeach
		</select>
		<span class="text-danger">{{ $errors->first($field['name']) }}</span>
	</div>

	<div class="col-sm-3">
		<small>{{ $field['hint'] ?? "" }}</small>
	</div>
</div>