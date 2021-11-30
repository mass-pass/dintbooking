<div class="form-group">
	@if($field['label'] == 'Image')
		<label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] ?? ''}} <span class="text-danger">*</span></label>
	@else
		<label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] ?? ''}}</label>
	@endif

	<div class="col-sm-6">
		<input type="file" name="{{ $field['name'] ?? '' }}" class="form-control {{ $field['class'] ?? ''}}" id="{{ $field['id'] ?? $field['name'] }}" value="{{ isset($_POST[$field['name']])?@$_POST[$field['name']]:@$field['value'] }}" placeholder="{{ @$field['label'] }}" {{ isset($field['readonly']) && $field['readonly']=='true'?'readonly':'' }}>
		<span class="text-danger">{{ $errors->first($field['name']) }}</span>
		{!! isset($field['image'])?'<br><img class="file-img" src="'.$field['image'].'">':'' !!}
		{!! isset($field['custom_span'])?'<span  name="mySpan" class="remove_logo_preview" id="mySpan"></span>':'' !!}
		{!! isset($field['custom_company_logo'])?'<input id="hidden_company_logo" name="hidden_company_logo" data-rel="'.$field['custom_company_logo'].'" type="hidden" >':'' !!}
		{!! isset($field['custom_span2'])?'<span  name="mySpan2" class="remove_favicon_preview" id="mySpan2"></span>':'' !!}
		{!! isset($field['custom_company_favicon'])?'<input id="hidden_company_favicon" name="hidden_company_favicon" data-rel="'.$field['custom_company_favicon'].'" type="hidden" >':'' !!}
	</div>

	<div class="col-sm-3">
		<small>{{ $field['hint'] ?? "" }}</small>
	</div>
</div>