@php 
$form_data = [
    'page_title'=> 'Add Property Type',
    'page_subtitle'=> '', 
    'form_name' => 'Add Property Type Form',
    'form_id' => 'add_property',
    'action' => URL::to('/').'/admin/settings/add-property-type',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => ''],
      ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'name' => 'description',  'value' => ''],
      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],

    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

            $('#add_property').validate({
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