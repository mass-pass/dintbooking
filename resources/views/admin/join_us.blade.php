@php
$form_data = [
    'page_title'=> 'Join Us',
    'page_subtitle'=> '', 
    'form_name' => 'Join Us Form',
    'action' => URL::to('/').'/admin/join_us',
    'fields' => [
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Facebook', 'name' => 'facebook', 'value' => $result[0]->value],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Google Plus', 'name' => 'google_plus', 'value' => $result[1]->value],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Twitter', 'name' => 'twitter', 'value' => $result[2]->value],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Linkedin', 'name' => 'linkedin', 'value' => $result[3]->value],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Pinterest', 'name' => 'pinterest', 'value' => $result[4]->value],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Youtube', 'name' => 'youtube', 'value' => $result[5]->value],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Instagram', 'name' => 'instagram', 'value' => $result[6]->value],
    ]
  ];
@endphp
@include("admin.common.form.primary", $form_data)