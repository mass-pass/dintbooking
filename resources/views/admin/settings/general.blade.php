@php 
if($result['logo']==null)
{
    $logoPath = "front/images/default-error-image.png";
}
else {
    $logoPath = 'front/images/logos/'.$result['logo'];
}

if($result['favicon']==null)
{
    $faviconPath = "front/images/default-error-image.png";
}
else {
    $faviconPath = 'front/images/logos/'.$result['favicon'];
}
$form_data = [
		'page_title'=> 'General Setting Form',
		'page_subtitle'=> 'General Setting Page', 
		'form_name' => 'General Setting Form',
		'form_id' => 'general_form',
		'action' => URL::to('/').'/admin/settings',
		'form_type' => 'file',
		'fields' => [ 
			['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => $result['name']],
            ['type' => 'file', 'class' => '', 'label' => 'Logo', 'name' => "photos[logo]", 'value' => '', 'image' => url($logoPath), 'custom_span' =>$result['logo'], 'custom_company_logo' => $result['logo']] ,
      		['type' => 'file', 'class' => 'validate_field', 'label' => 'Favicon', 'name' => "photos[favicon]", 'value' => '', 'image' => url($faviconPath), 'custom_span2' =>$result['favicon'], 'custom_company_favicon' => $result['favicon']],
      		['type' => 'textarea', 'class' => 'validate_field', 'label' => 'Head Code', 'name' => 'head_code', 'value' => $result['head_code']],
      		['type' => 'select', 'options' => $currency, 'class' => 'validate_field', 'label' => 'Default Currency', 'name' => 'default_currency', 'value' => $result['default_currency']],
              ['type' => 'select', 'options' => $language, 'class' => 'validate_field', 'label' => 'Default Language', 'name' => 'default_language', 'value' => $result['default_language']],
              
		]
	];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#general_form').validate({
                rules: {
                    name: {
                        required: true
                    },
                    'photos[logo]': {
                        //extension: "jpg|png|jpeg"
                        accept: "image/jpg,image/jpeg,image/png,image/gif"
                        //accept: "image/*"
                    },
                    'photos[favicon]': {
                        extension: "jpg|png|jpeg|ico"
                    },
                    default_currency: {
                        required: true
                    },
                    default_language: {
                        required: true
                    }
                },
                messages: {
                    'photos[logo]': {
                        accept: 'The file must be an image (jpg, jpeg, png or gif)'
                    },
                    'photos[favicon]': {
                        extension: 'The file must be an image (jpg, jpeg, png or ico)'
                    }
                } 
            });

        });

        $('.remove_logo_preview').on("click", function(){
        var image = $('#hidden_company_logo').attr('data-rel');
        var token = $('input[name="_token"]').val();

        if(image){
                console.log("hellow");
                $.ajax({
                url : "settings/delete_logo",
                type : "post",
                async : false,
                data: { 
                    'company_logo' : image,
                    "_token": token
                },
                dataType : 'json',
                success: function(reply)
                {
                    if (reply.success == 1){
                        alert(reply.message);
                        location.reload();

                    }else{
                        alert(reply.message);
                        location.reload();

                    }
                }
                });
            }
        
        });

        $('.remove_favicon_preview').on("click", function(){
        var image = $('#hidden_company_favicon').attr('data-rel');
        var token = $('input[name="_token"]').val();
        if(image){
                $.ajax({
                url : "settings/delete_favicon",
                type : "post",
                async : false,
                data: { 'company_favicon' : image, '_token' : token},
                dataType : 'json',
                success: function(reply)
                {
                    if (reply.success == 1){
                        alert(reply.message);
                        location.reload();

                    }else{
                        alert(reply.message);
                        location.reload();

                    }
                }
                });
            }
        
        });

</script>