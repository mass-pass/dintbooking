@php 
$form_data = [
		'page_title'=> 'Domain Form',
		'page_subtitle'=> 'Domain Page', 
		'form_name' => 'Domain Form',
		'form_id' => 'domains',
		'action' => URL::to('/').'/admin/settings/domains',
		'fields' => [
			
      		['type' => 'text', 'class' => '', 'label' => 'Guest Domain', 'name' => "guest_domain", 'value' => $result['guest_domain'], 'hint' => ''],
            ['type' => 'text', 'class' => '', 'label' => 'Partner Domain', 'name' => "partner_domain", 'value' => $result['partner_domain'], 'hint' => ''],
		]
	];
@endphp
@include("admin.common.form.setting", $form_data)
<script type="text/javascript">
   $(document).ready(function () {

            $('#domains').validate({
                rules: {
                    guest_domain: {
                        required: true
                    },
                    partner_domain: {
                        required: true
                    }
                }
            });

        });
</script>