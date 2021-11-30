@php
$form_data = [
		'page_title'=> 'Profile Edit Form',
		'page_subtitle'=> 'Edit your profile', 
		'form_name' => 'Profile Edit Form',
		'form_id' => 'profile_edit',
		'action' => URL::to('/').'/admin/profile',
		'form_type' => 'file',
		'fields' => [
			['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => $result->username],
      		['type' => 'text', 'class' => 'validate_field', 'label' => 'Email', 'name' => 'email', 'value' => $result->email, 'readonly' => 'true'],
      		['type' => 'password', 'class' => 'new_password', 'label' => 'Password', 'name' => 'password', 'value' => '', 'hint' => 'Enter new password only. Leave blank to use existing password.'],
      		['type' => 'password', 'class' => '', 'label' => 'Password Retype', 'name' => 'password_confirmation', 'value' => '', 'hint' => 'Enter new password only. Leave blank to use existing password.'],
			    ['type' => 'file', 'class' => '', 'label' => 'Photo', 'name' => 'profile_pic', 'value' => ''],
		]
	];
@endphp
@include("admin.common.form.primary", $form_data)

<script src="{{ asset('backend/js/additional-method.min.js') }}"></script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#profile_edit').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    password: {
                        maxlength: 50
                    },
                    password_confirmation: {
                        equalTo: ".new_password"
                    },
                    profile_pic: {
                        extension: "jpg|png|gif"
                        //accept: "image/jpg,image/gif,image/png"
                        //accept: "image/*"
                    }
                },
                messages: {
                    profile_pic: {
                        extension: 'The file must be an image (jpg, gif or png)'
                    }
                } 
            });

        });
</script>