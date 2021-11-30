@php 
$form_data = [
    'page_title'=> 'Edit Country',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Country Form',
    'form_id' => 'edit_country',
    'action' => URL::to('/').'/admin/settings/edit-country/'.$result->id,
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Short Name', 'name' => 'short_name', 'value' => $result->short_name],
        ['type' => 'text', 'class' => '', 'label' => 'Long Name', 'name' => 'name', 'value' => $result->name],
        ['type' => 'text', 'class' => '', 'label' => 'ISO3', 'name' => 'iso3', 'value' => $result->iso3],
        ['type' => 'text', 'class' => '', 'label' => 'Num Code', 'name' => 'number_code', 'value' => $result->number_code],
        ['type' => 'text', 'class' => '', 'label' => 'Phone Code', 'name' => 'phone_code', 'value' => $result->phone_code],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {

            $('#edit_country').validate({
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