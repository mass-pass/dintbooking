@php 
$form_data = [
		'page_title'=> 'Fees Setting Form',
		'page_subtitle'=> 'Fees Setting Page', 
		'form_name' => 'Fees Setting Form',
		'form_id' => 'fees_setting',
		'action' => URL::to('/').'/admin/settings/fees',
		'fields' => [
			
      		['type' => 'text', 'class' => '', 'label' => 'Guest service charge (%)', 'name' => "guest_service_charge", 'value' => $result['guest_service_charge'], 'hint' => 'service charge of guest for booking'],
            ['type' => 'text', 'class' => '', 'label' => 'Partner service charge (%)', 'name' => "partner_service_charge", 'value' => $result['partner_service_charge'], 'hint' => 'service charge of partner for booking'],
		]
	];
@endphp
@include("admin.common.form.setting", $form_data)
<script type="text/javascript">
   $(document).ready(function () {

            $('#fees_setting').validate({
                rules: {
                    guest_service_charge: {
                        required: true
                    },
                    partner_service_charge: {
                        required: true
                    }
                }
            });

        });
</script>