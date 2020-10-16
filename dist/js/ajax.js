$(document).ready(function(){

    var sessionId;
    var t = $("#Mensajes").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    var data = JSON.stringify({
                                "data": {
                                  "username": "armicasdi@gmail.com",
                                  "password": "0123Castro"
                                }
                              });

    function mensaje(id){
        console.log(id);
    }

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
        //sessionId = id;
       var resultadoConversaciones =  $.ajax({
            type: "GET",
            url: "http://api.ringbyname.com/sms/conversation",
            // headers: { "X-Session-Id" : sessionId},
            beforeSend: function(request){
                request.setRequestHeader("X-Session-Id", id)
            },
            success: function (response){
                var rows = response.data.rows;
                table(rows, sessionId);
                }
        });
    }

    function table(response, sessionId){
        for(var i = 0; i < response.length; i++){
            id = response[i].id
            sId = sessionId
            t.row.add([ "<span onclick='mensaje(sId, "+id+")'>"+response[i].contact_name+"</span>" ,  response[i].contact_phone_number , response[i].last_message.date_created ]);
        }
        //var muestra = (response.length-10);
        /*for(var i = indice; i > 0; i--){
            console.log(indice)
                color = response[i].is_read ? "" : "lightgray"
                id = response[i].id

            tr = $('#Mensajes tbody').after('<tr onclick="message(' + id + ' , ' + sessionId + ')" style="background-color: ' + color + '"><td> ' + response[i].contact_name + '   <span style="float: right">  ' + response[i].date_created+  '</span> </td></tr>')

            t.row.add([tr])
        }*/


        t.draw();

        $("#enviar").submit(function (e){
            var formData = {'message':$('input[name=message]').val()}
            let convo_id = $('input[name=convo_id]').val()

            console.log(sessionId)


            $.ajax({
                   type: "formData",
                   url: " http://api.ringbyname.com/sms/reply/"+message_reply_id,
                   data: formData,
                   beforeSend: function(request){
                                   request.setRequestHeader("X-Session-Id", id),
                                   request.setRequestheader('Access-Control-Allow-Origin:', '*'),
                                   request.setRequestheader('Access-Control-Allow-Methods:', 'POST, GET, OPTIONS, PUT, DELETE'),
                                   request.setRequestheader('Access-Control-Allow-Headers:', 'Origin, Content-Type, Accept, Authorization, X-Request-With')
                               },
                   success: function (response) {
                        console.log(response)
                   },
                   dataType: "json",
                   contentType: "application/json"
                 });



            e.preventDefault();
        })





    }


})