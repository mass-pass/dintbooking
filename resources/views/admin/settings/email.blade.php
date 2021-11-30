@php 
$form_data = [
    'page_title'=> 'Email Setting Form',
    'page_subtitle'=> 'Email Setting Page', 
    'form_name' => 'Email Setting Form',
    'form_id' => 'email_setting',
    'action' => URL::to('/').'/admin/settings/email',
    'fields' => [
      ['type' => 'select', 'options' => $drivers, 'class' => 'validate_field protocol_type', 'label' => 'Email Protocol', 'name' => 'driver', 'value' => $result['driver']],
          ['type' => 'text', 'class' => '', 'label' => 'Host', 'name' => 'host', 'value' => $result['host']],
          ['type' => 'text', 'class' => '', 'label' => 'Port', 'name' => 'port', 'value' => $result['port']],
          ['type' => 'text', 'class' => '', 'label' => 'From Address', 'name' => 'from_address', 'value' => $result['from_address']],
          ['type' => 'text', 'class' => '', 'label' => 'From Name', 'name' => 'from_name', 'value' => $result['from_name']],
          ['type' => 'text', 'class' => '', 'label' => 'Encryption', 'name' => 'encryption', 'value' => $result['encryption']],
          ['type' => 'text', 'class' => '', 'label' => 'Username', 'name' => 'username', 'value' => $result['username']],
          ['type' => 'text', 'class' => '', 'label' => 'Password', 'name' => 'password', 'value' => $result['password']],
          ['type' => 'hidden', 'class' => 'email_status_check', 'label' => 'Email Status','name' => 'email_status', 'value' =>$result['email_status']],
    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

            $('#email_setting').validate({
                rules: {
                    host: {
                        required: true
                    },
                    port: {
                        required: true
                    },
                    from_address: {
                        required: true
                    },
                    from_name: {
                        required: true
                    },
                    encryption: {
                        required: true
                    },
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                }
            });

        });
</script>