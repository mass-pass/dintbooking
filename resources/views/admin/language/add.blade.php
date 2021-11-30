@php 
$form_data = [
    'page_title'=> 'Add Language',
    'page_subtitle'=> '', 
    'form_name' => 'Add Language Form',
    'form_id' => 'add_language',
    'action' => URL::to('/').'/admin/settings/add-language',
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => old('name')],
        ['type' => 'text', 'class' => '', 'label' => 'Short Name', 'name' => 'short_name', 'value' => old('short_name')],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {
            $('#add_language').validate({
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