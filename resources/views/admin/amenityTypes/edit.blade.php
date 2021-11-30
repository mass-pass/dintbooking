@php 
$form_data = [
    'page_title'=> 'Edit Amenity Type',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Amenity Type Form',
    'form_id' => 'amenity_type',
    'action' => URL::to('/').'/admin/settings/edit-amenities-type/'.$result->id,
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => $result->name],
        ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'name' => 'description', 'value' => $result->description],
    ]
];
@endphp

@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {
            $('#amenity_type').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    description: {
                        required: true,
                    }
                }
            });
        });
</script>