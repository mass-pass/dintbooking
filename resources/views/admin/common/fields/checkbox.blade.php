<div class="form-group">
	<label class="col-sm-3 control-label">{{ $field['label'] ?? ''}}</label>
	<div class="col-sm-6">
		<ul class="ul-checkbox">
			@foreach($field['boxes'] as $value => $name)
				<li class="checkbox li-checkbox">
					<label>
						<input type="checkbox" name="{{ $field['name'] ?? '' }}" value="{{ $value }}" {{ (isset($field['value']) && in_array($value, $field['value'])) ? 'checked' : '' }}> 
						{{ $name }}
					</label>
				</li>
			@endforeach
		</ul>
	</div>
	<div class="col-sm-3">
		<small>{{ $field['hint'] ?? "" }}</small>
	</div>
</div>