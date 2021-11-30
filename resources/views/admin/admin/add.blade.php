@php 
$form_data = [
    'page_title'=> 'Add Admin User Form',
    'page_subtitle'=> 'Add Admin', 
    'form_name' => 'Admin Add Form',
    'form_id' => 'add_admin',
    'action' => URL::to('/').'/admin/add-admin',
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Username', 'name' => 'username', 'value' => ''],
        ['type' => 'text', 'class' => '', 'label' => 'Email', 'name' => 'email', 'value' => ''],
        ['type' => 'password', 'class' => '', 'label' => 'Password', 'name' => 'password', 'value' => ''],
        ['type' => 'select', 'options' =>$roles, 'class' => 'validate_field', 'label' => 'Role', 'name' => 'role', 'value' => ''],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.primary", $form_data)

<script type="text/javascript">

    jQuery.validator.addMethod("laxEmail", function(value, element) {
        return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
    }, 'Please enter a valid email address.');

    $(document).ready(function () {
            $('#add_admin').validate({
                rules: {
                    username: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                        maxlength: 255,
                        laxEmail: true
                    },
                    password: {
                        required: true,
                        maxlength: 50,
                        minlength: 6
                    }
                }
            });
        });
</script>