@php 
$form_data = [
    'page_title'=> 'Edit Metas',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Meta Form',
    'form_id' => 'edit_meta',
    'action' => URL::to('/').'/admin/settings/edit_meta/'.$result->id,
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => 'Page Url', 'name' => 'url', 'value' => $result->url],
      ['type' => 'text', 'class' => '', 'label' => 'Page Title', 'name' => 'title', 'value' => $result->title],
      ['type' => 'textarea', 'class' => '', 'label' => 'Meta Description', 'name' => 'description', 'value' => $result->description],
      ['type' => 'textarea', 'class' => '', 'label' => 'Keywords', 'name' => 'keywords', 'value' => $result->keywords],
    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

            $('#edit_meta').validate({
                rules: {
                    url: {
                        required: true
                    },
                    title: {
                        required: true
                    },
                    description: {
                        required: true
                    },/*
                    keywords: {
                        required: true
                    }*/
                }
            });

        });
</script>