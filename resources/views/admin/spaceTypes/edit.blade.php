@php 
$form_data = [
    'page_title'=> 'Edit Space Type',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Space Type Form',
    'form_id' => 'edit_space',
    'action' => URL::to('/').'/admin/settings/edit-space-type/'.$result->id,
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => $result->name],
      ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'name' => 'description', 'value' => $result->description],
      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status],

    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

            $('#edit_space').validate({
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