@php 
$form_data = [
    'page_title'=> 'Add Bed Type',
    'page_subtitle'=> '', 
    'form_name' => 'Add Bed Type Form',
    'form_id' => 'add_bed',
    'action' => URL::to('/').'/admin/settings/add-bed-type',
    'fields' => [
    ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {
            $('#add_bed').validate({
                rules: {
                    name: {
                        required: true
                    }
                }
            });
        });
</script>