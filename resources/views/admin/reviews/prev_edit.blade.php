@php 
$form_data = [
    'page_title'=> 'Edit Review Form'.$result->id,
    'page_subtitle'=> 'Edit Review Form', 
    'form_name' => 'Review Edit Form',
    'action' => URL::to('/').'/admin/edit_review/'.$result->id,
    'fields' => [
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Booking Id', 'name' => 'booking_id', 'value' => $result->booking_id,'readonly' =>'true'],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Proptery Name', 'name' => 'property_name', 'value' => $result->property_name],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Sender', 'name' => 'sender', 'value' => $result->sender],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Reciever', 'name' => 'reciever', 'value' => $result->reciever],
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Reviewer', 'name' => 'reviewer', 'value' => $result->reviewer],
      ['type' => 'checkbox', 'boxes' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'switch', 'label' => 'Status', 'name' => 'status', 'value' => @$result->status]
    ]
  ];
@endphp
@include("admin.common.form.primary", $form_data)