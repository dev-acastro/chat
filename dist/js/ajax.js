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
                table(rows);
                }
        });
    }
    function table(response){

        var indice = (response.length-1);
        var muestra = (response.length-10);



        for(var i = indice; i > muestra; i--){
                color = response[i].is_read ? "lightgray" : ""
                console.log(color);
            $('#Mensajes tbody').after('<tr style="background-color: ' + color + '"><td> ' + response[i].contact_name + ' </td></tr>')

        }
        datatables();
    }










})