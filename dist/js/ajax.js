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
       beforeSend: function(request){   
                       $('.overlay').show();
                       $(".loader").show();
                   },
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
                request.setRequestHeader("X-Session-Id", id),
            },
            complete: function(){
                $(".loader").hide();
                $('.overlay').hide();
            },
            success: function (response){
                var rows = response.data.rows;
                table(rows, sessionId);
                }
        });
    }

    function table(response, sessionId) {
        for (var i = 0; i < response.length; i++) {
            let date = new Date(response[i].last_message.date_created);
            let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour12:false }
            let dateFormated = date.toLocaleString('default', options);
            let time = date.toLocaleTimeString('en-US');
            id = response[i].id
            sId = sessionId
            let read = response[i].isread = true ? '' :  '<i class="fas fa-circle" style="color: lightblueblue; "></i>';

            t.row.add([read +"<span onclick='mensaje(sId, " + id + ")' style='margin-left: 10px'>" + response[i].contact_name + "</span>", response[i].contact_phone_number, dateFormated + "  " + time]);
        }
        t.draw();


    }

        $("#enviar").submit(function(event){
              event.preventDefault();
             let mensajePut = $("input[name=message]").val()
             let convo_id = $("input[name=convo_id]").val()
              $.ajax({
                    type: "PUT",
                    url: "http://api.ringbyname.com/sms/reply/"+convo_id,
                    data: JSON.stringify({"data":{"message" : mensajePut}}),
                    beforeSend: function(request){
                         request.setRequestHeader("X-Session-Id", sessionId)
                    },
                    success: mensaje(sessionId, convo_id),
                    dataType: "json",
                    contentType: "application/json"
                  });
            mensajeReload(mensajePut)
        });

    function mensajeReload(mensaje ){
      let date = new Date();
      let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour12:false }
      let dateFormated = date.toLocaleString('default', options);
      let time = date.toLocaleTimeString('en-US');


      $("#mensaje").before('<div class="col-6 mensaje" style="margin: 20px 10px; padding:20px 20px 10px 20px; clear:both; float:right; background-color: lightblue " >' + mensaje + '<p style="margin: 15px 0 0 0; clear:both; color: gray; font-size: 14px; float: right">' + dateFormated + '</p><p style="margin: 0px 0 0 0; clear:both; color: gray; font-size: 14px; float: right">' + time + '</p></div>')
        $('#messagesWrapper').animate({scrollTop:$('#messagesWrapper').prop("scrollHeight")}, 2500);
        $("input[name=message]").val("")

    }


    $("#close").click(function(){
        $('#MovedWraper').animate({left:'100vw'}, 1000);
        $('.overlay').hide(1000);
    })

    $("#wrapper").click(function(){
            $('#MovedWraper').animate({left:'100vw'}, 1000);
            $('.overlay').hide(1000);
        })




})