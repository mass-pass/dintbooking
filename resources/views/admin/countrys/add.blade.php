@php 
$form_data = [
    'page_title'=> 'Add Country',
    'page_subtitle'=> '', 
    'form_name' => 'Add Country Form',
    'form_id' => 'add_country',
    'action' => URL::to('/').'/admin/settings/add-country',
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Short Name', 'name' => 'short_name', 'value' => ''],
        ['type' => 'text', 'class' => '', 'label' => 'Long Name', 'name' => 'name', 'value' => ''],
        ['type' => 'text', 'class' => '', 'label' => 'ISO3', 'name' => 'iso3', 'value' => ''],
        ['type' => 'text', 'class' => '', 'label' => 'Num Code', 'name' => 'number_code', 'value' => ''],
        ['type' => 'text', 'class' => '', 'label' => 'Phone Code', 'name' => 'phone_code', 'value' => ''],

    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {

            $('#add_country').validate({
                rules: {
                    short_name: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    iso3: {
                        required: true
                    },
                    number_code: {
                        required: true
                    },
                    phone_code: {
                        required: true
                    }
                }
            });

        });
</script>