@php 
$form_data = [
    'page_title'=> 'Add Role',
    'page_subtitle'=> '', 
    'form_name' => 'Add Role Form',
    'form_id' => 'add_role',
    'action' => URL::to('/').'/admin/settings/add-role',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => old('name')],
      ['type' => 'text', 'class' => '', 'label' => 'Display Name', 'name' => 'display_name', 'value' => old('display_name')],
      ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'name' => 'description', 'value' => old('description')],
      ['type' => 'checkbox', 'boxes' => $permissions, 'class' => 'validate_field', 'label' => 'Permissions', 'name' => 'permission[]'],
    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">

  jQuery.validator.addMethod("letters_with_spaces", function(value, element)
  {
    return this.optional(element) || /^[A-Za-z ]+$/i.test(value); //only letters
  }, "Please enter letters only!");

  $.validator.setDefaults({
      highlight: function(element) {
        $(element).parent('div').addClass('has-error');
      },
      unhighlight: function(element) {
       $(element).parent('div').removeClass('has-error');
     },
     errorPlacement: function (error, element) {
      if (element.prop('type') === 'checkbox') {
        $('#error-message').html(error);
      } else {
        error.insertAfter(element);
      }
    }
  });
  
   $(document).ready(function () {

            $('#add_role').validate({
                rules: {
                    name: {
                        required: true
                    },
                    display_name: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    "permission[]": {
                      required: true,
                      minlength: 1
                    },

                },
                messages: {
                  "permission[]": {
                    required: "Please select at least one checkbox!",
                  },
                },
            });

        });
</script>