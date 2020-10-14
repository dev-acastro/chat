$(document).ready(function(){

    var data = JSON.stringify({
                                "data": {
                                  "username": "armicasdi@gmail.com",
                                  "password": "0123Castro"
                                }
                              });

      var sessionId;

     $.ajax({
       type: "POST",
       url: " http://api.ringbyname.com/auth",
       data: data,
       success: function(data){
        sessionId = data.data.state_id;
       },
       dataType: "json",
       contentType: "application/json"
     });


    $.ajax({
           type: "GET",
           url: "http://api.ringbyname.com/sms/conversation",
          // headers: { "X-Session-Id" : sessionId},
           beforeSend: function(request){
            request.setRequestHeader("X-Session-Id", sessionId)
           },
           success: function(data){
            console.log(data)
           },
         });


})