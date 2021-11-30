@php 
$form_data = [
		'page_title'=> 'Sendmail Setting Form',
		'page_subtitle'=> 'Sendmail Setting Page', 
		'form_name' => 'Sendmail Setting Form',
		'action' => URL::to('/').'/admin/settings/email',
		'fields' => [
			['type' => 'text', 'class' => 'validate_field', 'label' => 'Driver', 'name' => 'driver', 'value' => $result['driver']],
			['type' => 'select', 'options' => $currency, 'class' => 'validate_field', 'label' => 'Email Protocol', 'name' => 'default_currency', 'value' => $result['default_currency']],

		]
	];
@endphp
@include("admin.common.form.setting", $form_data)