<div class="contentArea-chat">
    <div class="contentArea-chat-header">
        <a href="#" class="backBtn">
            <i class="fa fa-chevron-left"></i>
        </a>
        <h4>{{$booking->users->first_name}} {{$booking->users->last_name}}
            <small>Booking number: {{$booking->code}}</small>
        </h4>
        <a href="#" class="shareLink">
            <i class="fas fa-external-link-alt"></i>
        </a>

    </div>
    <?php
        $messages = $booking->messages;
//        pe($messages);
    ?>
    <div class="contentArea-chat-body">
        @foreach($messages as $k => $v)
            <div class="chat-item {{($v->sender_id === auth()->user()->id)?'receiver':'sender'}}">
                <div class="chat-date">
                    {{$v->created_at->format('M d,Y h:i a')}}
                </div>
                <span class="icon"> <i class="fas fa-user-circle"></i> </span>
                <div class="chat-text">
                    <p class="mb-0">{{$v->message}}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="contentArea-chat-footer">
{{--        <div class="chat-footer-btns">--}}
{{--            <button type="button" class="btn btn-primary btn-lg mr-md-2" onclick="subForm()">Reply</button>--}}
{{--            <button type="button" class="btn btn-outline-primary btn-lg"><i class="fa fa-thumbs-up"></i>&nbsp; Say thanks</button>--}}
{{--        </div>--}}
        <div class="chat-footer-form" id="submit-form">
            <form id="newMessageForm" class="new-message-form" action="#">
                @csrf
                <input type="hidden" name="property_id" value="{{$booking->property_id}}">
                <input type="hidden" name="booking_id" value="{{$booking->id}}">
                <input type="hidden" name="sender_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="receiver_id" value="{{$booking->user_id}}">
                <textarea name="new_message" id="new_message" class="textarea" rows="1" placeholder="Your message"></textarea>
                <button type="submit" id="submitNewMessage" class="btn btn-primary">
                    <i class="fa fa-paper-plane"></i>&nbsp; Send
                </button>
{{--                <button type="button" class="btn btn-outline-primary btn-lg"><i class="fa fa-thumbs-up"></i>&nbsp; Say thanks</button>--}}
            </form>
        </div>
    </div>
</div>

<script>
    //submit new message from chat panel
    $('#newMessageForm').submit(function(e){
        e.preventDefault();
        submitNewMessage();
    });
    //will send new message to the server
    function submitNewMessage()
    {
        let formData = $('#newMessageForm').serialize();
        let $newMsgField = $('#new_message');
        let newMsg = $newMsgField.val().trim();
        //only send message if something is written
        //else should not send the message
        if(newMsg.length > 1 ){

            /**
             * quick message script starts
             * this block is added just to make better user experience
             * so that message may appear on the chat as soon as the user click on the message
             * what if error occurs while submitting chat
             * on error block just show some error on now-message block like failed
             * else on success
             * update the time now to the time returened from server
             **/
            let msgToAppend = '<div class="chat-item receiver now-message">'+
                '<div class="chat-date">'+
                'now'+
                '</div>'+
                '<span class="icon"> <i class="fas fa-user-circle"></i> </span>'+
                '<div class="chat-text">'+
                '<p class="mb-0">'+newMsg+'</p>'+
                '</div>'+
                '</div>';
            $('.contentArea-chat-body').append(msgToAppend);
            $newMsgField.val("");
            //quick message block ends

            $.ajax({
                url: APP_URL+'/partner/inbox/new-message',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                beforeSend:function(){
                },
                success:function(resp){
                    $('.now-message .chat-date').text(resp.created_at);
                    $('.chat-item.receiver').removeClass('now-message');
                },
                error: function(xhr){

                }
            })
        }
    }

</script>