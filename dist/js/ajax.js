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

    function table(response, sessionId) {
        for (var i = 0; i < response.length; i++) {
            id = response[i].id
            sId = sessionId
            t.row.add(["<span onclick='mensaje(sId, " + id + ")'>" + response[i].contact_name + "</span>", response[i].contact_phone_number, response[i].last_message.date_created]);
        }
        t.draw();


    }

    $("#enviar").submit(function (e) {
        e.preventDefault();
        var mensajePut = $('input[name=message]').val()
        let convo_id = $('input[name=convo_id]').val()
         $.ajax({
                type: "PUT",
                url: "http://api.ringbyname.com/sms/reply/"+convo_id,
                data: JSON.stringify({
                 "data":{
                     "message" : mensajePut
                 }
                }),
                beforeSend: function(request){
                     request.setRequestHeader("X-Session-Id", sessionId)
                },
                success: mensaje(sessionId, convo_id),
                dataType: "json",
                contentType: "application/json"
              });

        mensajeReload(sessionId, convo_id)
    })

    function mensajeReload(sessionId, id ){
        $("#messagesWrapper").html(`<div id="mensaje"  class="mensaje" style="position: absolute; bottom: 0; height: 100px; width: 100%" >
                </div>`)


        $.ajax({
            type: "GET",
            url: "http://api.ringbyname.com/sms/message?search=conversation.id:"+id,
            // headers: { "X-Session-Id" : sessionId},
            beforeSend: function(request){
                request.setRequestHeader("X-Session-Id", sessionId)
            },
            success: function (response){
                rows = response.data.rows
                last_index = rows.length -1;
                convo_id = rows[last_index].conversation.id;
                console.log(sessionId)

                for(let y = 0; y < rows.length; y++){
                    let mensaje = rows[y].message
                    let date = rows[y].date_created
                    inbound = rows[y].is_inbound ? "left" : "right"
                    backcolor = rows[y].is_inbound ? "lightgreen" : "lightblue"

                    $("#mensaje").before('<div class="col-4 mensaje" style="margin: 20px 10px; padding:20px 20px; clear:both; float:'+ inbound + '; background-color: '+ backcolor + ' " >' + mensaje + '<p style="margin-top: 25px; clear:both; color: gray; font-size: 14px; float: right">' + date + '</p></div>')
                }

                $('#messagesWrapper').animate({scrollTop:$('#messagesWrapper').prop("scrollHeight")}, 2500);

                fillForm(convo_id);
            }

        });


    }

    function fillForm(id){

        $("input:hidden").val(id);
        $("input:text").val("");


    }



})