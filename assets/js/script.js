$(function() {
    var user_id = $('p').data('id');
    var id = '';
    var url_base = 'http://localhost/chat/'
    $('.user_target').click(function(){
        // even.preventDefault();
        $('#scroll').animate({scrollTop: $('#scroll').prop('scrollHeight')});

        let content = '';
        let foto_target = '';
        
        id = ($(this).data('id'));
        var data = {id_target: id, user_id: user_id};
        
  
        $.ajax({
            url: url_base +'Message/getUserData',
            data: {data: data},
            method: 'post',
            datatype: 'json',
            success: function(data_target){
                dataT = JSON.parse(data_target);
                let messages = dataT.message;
                foto_target += ' <a><div class="target_message"></div><img src="assets/img/'+ dataT.target_data.image +'" class="rounded-circle float-left" alt="" width="60px" height="60px"></a><h4 class="ml-2"><b class="text text-light"> '+ dataT.target_data.name +' </b></h4>'
                $.each(messages, function(i, pesan) {
                    
                    if(pesan.user_id == id){
                        content += '<div id="1" class="row"><img src="'+ url_base +'assets/img/'+ dataT.target_data.image +'" alt="" width="30px" height="30px" class="mt-2 rounded-circle"><li class="message_send mt-3 d-flex justify-content-start col-md-7" > '+ pesan.message +' </li></div>'
                    } else if( pesan.user_id == user_id ){
                        content += '<div class="row 2"><li class="message_receipt mt-3 d-flex justify-content-end col-md-7"> '+ pesan.message +' </li><img src="assets/img/' + dataT.target_user.image + '" alt="" width="30px" height="30px" class="mt-2 rounded-circle"></div>';
                    }   
                    
                })
                $('#in').html(content);
                $('#fototarget').html(foto_target);
            }
        })
        
    })

    //form

    $(document).ready(function() {
        
        $("#message").keypress(function(e) {
            if(e.which == 13) {
               
                let content = '';
                var message = $('#message').val();
                var data = {message: message, id_target: id, user_id: user_id};
                const urL = 'message/sendMessage' //sending
                getData(data, content, urL);


                $('#message').val("");


            }
        });
      
        $("#send").click(function() {
            var a = $('#message').val();
            let content = '';
            var message = $('#message').val();
            var data = {message: message, id_target: id, user_id: user_id};
            const urL = 'message/sendMessage' //sending
            getData(data, content, urL);

            $('#message').val("");
        })
      });


      // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('65d281942673c0bd54b4', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        if(data.message === 'success'){
            let content = '';
            var data = {id_target: id, user_id: user_id};
            const urL = 'message/getUserData' //get message
            getData(data, content, urL);
        }
    });


    function getData(data,content,urL){
        $.ajax({
            url: url_base + urL,
            data: {data : data},
            method: 'post',
            datatype: 'json',
            success: function(data_target){
                dataT = JSON.parse(data_target);
                let messages = dataT.message;
                $.each(messages, function(i, pesan) {
            
            if(pesan.user_id == id){
                content += '<div id="1" class="row"><img src="'+ url_base +'assets/img/'+ dataT.target_data.image +'" alt="" width="30px" height="30px" class="mt-2 rounded-circle"><li class="message_send mt-3 d-flex justify-content-start col-md-7" > '+ pesan.message +' </li></div>'
            } else if( pesan.user_id == user_id ){
                content += '<div class="row 2"><li class="message_receipt mt-3 d-flex justify-content-end col-md-7"> '+ pesan.message +' </li><img src="assets/img/' + dataT.target_user.image + '" alt="" width="30px" height="30px" class="mt-2 rounded-circle"></div>';
            }   
            
        })
        $('#in').html(content);
        $('#scroll').animate({scrollTop: $('#scroll').prop('scrollHeight')});

            }
        
        })    
    }


})