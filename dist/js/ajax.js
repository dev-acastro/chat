$(document).ready(function(){

    function mensaje(id){
        console.log(id);

    }

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
       success: function (response) {
           sessionId = response.data.session_id;
           conversations(sessionId);
       },
       dataType: "json",
       contentType: "application/json"
     });

    function conversations(id){
        sessionId = id;

        $.ajax({
            type: "GET",
            url: "http://api.ringbyname.com/sms/conversation",
            // headers: { "X-Session-Id" : sessionId},
            beforeSend: function(request){
                request.setRequestHeader("X-Session-Id", sessionId)
            },
            success: function (response){
                var rows = response.data.rows;

                Tabla(rows);


            }
        });
    }




    function Tabla (response){
        response.forEach(function (item, index){
            $('#Mensajes tbody').after('<tr><td> ' + item.contact_name + ' </td><td>  ' + item.last_message.message + ' </td><td><a  href="sms.php?id=' + item.contact_id + '" class="btn btn-primary" style="color: white">Ver Chat</a></td></tr>')
        })
        datatables();


    }








})