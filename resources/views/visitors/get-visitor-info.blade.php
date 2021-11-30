<script src="{{asset('vendor/geo-fetch/geo-fetch.js')}}"></script>

<script>
    $(function(){
        <!-- Following function call will get the visitor information like ip,city,country ... -->
        let visitorInfo = userIPInfo;
        $('#userInfoIp').val(JSON.stringify(visitorInfo));
        if(localStorage.getItem('visitor_ip') === null){
            $.ajax({
                url: "/visitors",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_info: visitorInfo,
                },
                beforeSend:function(){
                },
                success:function(resp){
                    localStorage.setItem('visitor_ip',visitorInfo['ip']);
                },
                error: function(xhr){
                    let obj = JSON.parse(xhr.responseText);
                    console.log("error while saving visitor info >>", obj);
                }
            })
        }
    });
</script>