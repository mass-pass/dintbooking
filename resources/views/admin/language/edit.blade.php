@php 
$form_data = [
    'page_title'=> 'Edit Language',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Language Form',
    'form_id' => 'edit_language',
    'action' => URL::to('/').'/admin/settings/edit-language/'.$result->id,
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => $result->name ],
        ['type' => 'text', 'class' => '', 'label' => 'Short Name', 'name' => 'short_name', 'value' => $result->short_name],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {
        $('#edit_language').validate({
            rules: {
                name: {
                    required: true
                },
                short_name: {
                    required: true
                }
            }
        });
    });
</script>