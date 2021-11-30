@php 
$form_data = [
        'page_title'=> 'Social Setting Form',
        'page_subtitle'=> 'Social Setting Page', 
        'form_name' => 'Social Setting Form',
        'form_id' => 'social_setting',
        'action' => URL::to('/').'/admin/settings/social-links',
        'fields' => [
            ['type' => 'text', 'class' => 'not-require', 'label' => 'Facebook', 'name' => 'facebook', 'value' => $result['facebook']],
            ['type' => 'text', 'class' => 'not-require', 'label' => 'Google Plus', 'name' => 'google_plus', 'value' => $result['google_plus']],
            ['type' => 'text', 'class' => 'not-require', 'label' => 'Twitter', 'name' => 'twitter', 'value' => $result['twitter']],
            ['type' => 'text', 'class' => 'not-require', 'label' => 'Linkedin', 'name' => 'linkedin', 'value' => $result['linkedin']],
            ['type' => 'text', 'class' => 'not-require', 'label' => 'Pinterest', 'name' => 'pinterest', 'value' => $result['pinterest']],
            ['type' => 'text', 'class' => 'not-require', 'label' => 'Youtube', 'name' => 'youtube', 'value' => $result['youtube']],
            ['type' => 'text', 'class' => 'not-require', 'label' => 'Instagram', 'name' => 'instagram', 'value' => $result['instagram']],

        ]
    ];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

        });
</script>