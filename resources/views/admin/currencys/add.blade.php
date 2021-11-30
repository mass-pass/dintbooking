@php 
$form_data = [
    'page_title'=> 'Add Currency',
    'page_subtitle'=> '', 
    'form_name' => 'Add Currency Form',
    'form_id' => 'add_currency',
    'action' => URL::to('/').'/admin/settings/add-currency',
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => old('name')],
        ['type' => 'text', 'class' => '', 'label' => 'Code', 'name' => 'code', 'value' => old('code')],
        ['type' => 'text', 'class' => '', 'label' => 'Symbol', 'name' => 'symbol', 'value' => old('symbol')],
        ['type' => 'text', 'class' => '', 'label' => 'Rate', 'name' => 'rate', 'value' => old('rate')],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {
            $('#add_currency').validate({
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