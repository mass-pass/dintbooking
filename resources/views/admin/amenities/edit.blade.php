@php
$form_data = [
		'page_title'=> 'Amenity Edit Form',
		'page_subtitle'=> 'Edit Amenity', 
		'form_name' => 'Amenity Edit Form',
		'form_id' => 'edit_amen',
		'action' => URL::to('/').'/admin/edit-amenities/'.$result->id,
		'fields' => [
            ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'title', 'value' => $result->title],
            ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'name' => 'description', 'value' => $result->description],
            ['type' => 'text', 'class' => '', 'label' => 'Symbol', 'name' => 'symbol', 'value' =>$result->symbol],
            ['type' => 'select', 'options' =>$am, 'class' => 'validate_field', 'label' => 'Type', 'name' => 'type_id', 'value' =>$result->type_id],
            ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status]
		]
	];
@endphp
@include("admin.common.form.primary", $form_data)

<script type="text/javascript">
    $(document).ready(function () {
            $('#edit_amen').validate({
                rules: {
                    title: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    symbol: {
                        required: true
                    }
                }
            });
        });
</script>