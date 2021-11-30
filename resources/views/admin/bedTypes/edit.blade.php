@php 
$form_data = [
	'page_title'=> 'Edit Bed Type',
	'page_subtitle'=> '', 
	'form_name' => 'Edit Bed Type Form',
	'form_id' => 'edit_bed',
	'action' => URL::to('/').'/admin/settings/edit-bed-type/'.$result->id,
	'fields' => [
	['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => $result->name],
	]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
$(document).ready(function () {
	$('#edit_bed').validate({
		rules: {
			name: {
				required: true
			}
		}
	});
});
</script>