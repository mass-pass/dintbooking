@php 
$form_data = [
    'page_title'=> 'Edit Admin User Form',
    'page_subtitle'=> 'Edit Admin', 
    'form_name' => 'Admin Edit Form',
    'form_id' => 'edit_admin',
    'action' => URL::to('/').'/admin/edit-admin/'.$result->id,
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Username', 'name' => 'username', 'value' => $result->username],
        ['type' => 'text', 'class' => '', 'label' => 'Email', 'name' => 'email', 'value' => $result->email],
        ['type' => 'password', 'class' => '', 'label' => 'Password', 'name' => 'password', 'value' => '', 'hint' => 'Enter new password only. Leave blank to use existing password.'],
        ['type' => 'select', 'options' =>$roles, 'class' => 'validate_field', 'label' => 'Role', 'name' => 'role', 'value' => $role_id],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status],
    ]
];
@endphp
@include("admin.common.form.primary", $form_data)

<script type="text/javascript">

    jQuery.validator.addMethod("laxEmail", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
    }, 'Please enter a valid email address.');

    $(document).ready(function () {
            $('#edit_admin').validate({
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
                        maxlength: 50,
                        minlength: 6,
                    }
                }
            });
        });
</script>