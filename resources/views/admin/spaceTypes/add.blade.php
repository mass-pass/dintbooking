@php 
$form_data = [
    'page_title'=> 'Add Space Type',
    'page_subtitle'=> '', 
    'form_name' => 'Add Space Type Form',
    'form_id' => 'add_space',
    'action' => URL::to('/').'/admin/settings/add-space-type',
    'fields' => [
      ['type' => 'text', 'class' => 'validate_field', 'label' => 'Name', 'name' => 'name', 'value' => ''],
      ['type' => 'textarea', 'class' => 'validate_field', 'label' => 'Description', 'name' => 'description', 'value' => ''],
      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],

    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

            $('#add_space').validate({
                rules: {
                    name: {
                        required: true
                    },
                    description: {
                        required: true
                    }
                }
            });

        });
</script>