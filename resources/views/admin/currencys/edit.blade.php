@php 
$form_data = [
    'page_title'=> 'Edit Currency',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Currency Form',
    'form_id' => 'edit_currency',
    'action' => URL::to('/').'/admin/settings/edit-currency/'.$result->id,
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => $result->name],
        ['type' => 'text', 'class' => '', 'label' => 'Code', 'name' => 'code', 'value' => $result->code],
        ['type' => 'text', 'class' => '', 'label' => 'Symbol', 'name' => 'symbol', 'value' => $result->org_symbol],
        ['type' => 'text', 'class' => '', 'label' => 'Rate', 'name' => 'rate', 'value' => $result->rate],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {
            $('#edit_currency').validate({
                rules: {
                    name: {
                        required: true
                    },
                    code: {
                        required: true
                    },
                    symbol: {
                        required: true
                    },
                    rate: {
                        required: true
                    }
                }
            });
        });
</script>