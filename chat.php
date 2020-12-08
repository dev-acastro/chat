<?php /*
    include 'include/funciones.php';
*/?>

<!doctype html>
<html lang="en">

<head>

<!--    --><?php //include 'head.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <style>
        table.dataTable thead {
            background: linear-gradient(to right, #4A00E0, #8E2DE2);
            color: white;
        }
    </style>

</head>

<body>

<div class="wrapper" style="margin-top: 100px; padding: 10px;">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin: 0">



        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row rowContainer">
                    <div class="col-md-6 dataTableContainer">

                        <div class="card">
                            <div class="card-header">Messages</div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <a id="new" class="btn btn-primary" style="float: right">Nuevo Mensaje</a>
                                <table id="Mensajes" class="table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Contact</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Contact</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->



                    <div class="col-md-6" id="newDialog"
                         style="height: 90vh; border: 1px solid lightgrey; background-color: white; display: none">
                        <div id="messagesWrapper" class="col-12"
                             style=" height: 70vh; overflow-y: scroll">
                        </div>
                        <div class="col-12" style="width: 100%; height: 100px; ">
                            <form id="enviarNew">
                                <label>Numero de Telefono</label> <input type="number" name="receiver" class="col-6">
                                <input type="text" name="newConvo"
                                       style="width: 100%; padding: 20px 30px; margin: 10px; ">


                                <input class="col-12 btn btn-primary" type="submit">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6" id="MovedWraper"
                        style="height: 90vh; border: 1px solid lightgrey; background-color: white">
                        <div id="messagesWrapper" class="col-12"
                            style=" height: 70vh; overflow-y: scroll">
                        </div>
                        <div class="col-12" style="width: 100%; height: 100px; ">
                            <form id="enviar">
                                <input type="text" name="message"
                                    style="width: 100%; padding: 20px 30px; margin: 10px; ">
                                <input id="message_id" type="hidden" name="convo_id" value="">
                                <input class="col-12 btn btn-primary" type="submit">
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
</div>



    <!-- DATATABLE -->


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/demo.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs4/1.10.22/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>



<script>
        $(document).ready(function () {

            $("#new").click(function (){


                $("#newDialog").show();
                $("#MovedWraper").hide();
            })

            var sessionId;
            var t = $("#Mensajes").DataTable({
                "responsive": true,
                "autoWidth": false,
                /* "order": [
                        [2, "desc"]
                    ] */
            });
            
            var data = JSON.stringify({
                "data": {
                    "username": "armicasdi@gmail.com",
                    "password": "0123Castro"
                }
            });



            $.ajax({
                type: "POST",
                url: " https://api.ringbyname.com/auth",
                data: data,
                success: function (response) {
                    sessionId = response.data.session_id;
                    conversations(sessionId);
                },
                dataType: "json",
                contentType: "application/json"
            });

            function conversations(id) {
                //sessionId = id;
                var resultadoConversaciones = $.ajax({
                    type: "GET",
                    url: "https://api.ringbyname.com/sms/conversation",
                    // headers: { "X-Session-Id" : sessionId},
                    beforeSend: function (request) {
                        request.setRequestHeader("X-Session-Id", id)
                    },
                    success: function (response) {
                        var rows = response.data.rows;
                        table(rows, sessionId);
                    }
                });
            }

            function table(response, sessionId) {
                for (var i = 0; i < response.length; i++) {
                    let date = new Date(response[i].last_message.date_created);
                    let options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour12: false
                    }
                    let dateFormated = date.toLocaleString('default', options);
                    let time = date.toLocaleTimeString('en-US');
                    id = response[i].id
                    sId = sessionId
                    t.row.add(["<span style='cursor: pointer;' onclick='mensaje(sId, " + id + ")'><b>" + response[i].contact_name +
                        "</b></span>", response[i].contact_phone_number, dateFormated + "  " + time
                    ]);
                }
                t.draw();


            }

            $("#enviar").submit(function (e) {
                e.preventDefault();
                var mensajePut = $('input[name=message]').val()
                let convo_id = $('input[name=convo_id]').val()
                $.ajax({
                    type: "PUT",
                    url: "https://api.ringbyname.com/sms/reply/" + convo_id,
                    data: JSON.stringify({
                        "data": {
                            "message": mensajePut
                        }
                    }),
                    beforeSend: function (request) {
                        request.setRequestHeader("X-Session-Id", sessionId)
                    },
                    success: mensaje(sessionId, convo_id),
                    dataType: "json",
                    contentType: "application/json"
                });

                mensajeReload(sessionId, convo_id)
            })

            $("#enviarNew").submit(function (e) {
                e.preventDefault();
                var newConvo = $('input[name=newConvo]').val()
                let receiver = $('input[name=receiver]').val()
                let sender = "7033939393"

                $.ajax({
                    type: "POST",
                    url: "https://api.ringbyname.com/sms/send",
                    data: JSON.stringify({
                        "data": {
                            "sender": sender,
                            "receiver": receiver,
                            "message": newConvo

                        }
                    }),
                    beforeSend: function (request) {
                        request.setRequestHeader("X-Session-Id", sessionId)
                    },
                    success: mensaje(sessionId, convo_id),
                    dataType: "json",
                    contentType: "application/json"
                });

                mensajeReload(sessionId, convo_id)
            })

            function mensajeReload(sessionId, id) {
                $("#messagesWrapper").html(`<div id="mensaje"  class="mensaje" style="position: absolute; bottom: 0; height: 100px; width: 100%" >
                </div>`)


                $.ajax({
                    type: "GET",
                    url: "https://api.ringbyname.com/sms/message?search=conversation.id:" + id,
                    // headers: { "X-Session-Id" : sessionId},
                    beforeSend: function (request) {
                        request.setRequestHeader("X-Session-Id", sessionId)
                    },
                    success: function (response) {
                        rows = response.data.rows
                        last_index = rows.length - 1;
                        convo_id = rows[last_index].conversation.id;
                        console.log(sessionId)

                        for (let y = 0; y < rows.length; y++) {
                            let mensaje = rows[y].message
                            let date = rows[y].date_created
                            inbound = rows[y].is_inbound ? "left" : "right"
                            backcolor = rows[y].is_inbound ? "lightgreen" : "lightblue"

                            $("#mensaje").before(
                                '<div class="col-4 mensaje" style="margin: 20px 10px; padding:20px 20px; clear:both; float:' +
                                inbound + '; background-color: ' + backcolor + ' " >' +
                                mensaje +
                                '<p style="margin-top: 25px; clear:both; color: gray; font-size: 14px; float: right">' +
                                date + '</p></div>')
                        }

                        $('#messagesWrapper').animate({
                            scrollTop: $('#messagesWrapper').prop("scrollHeight")
                        }, 2500);

                        fillForm(convo_id);
                    }

                });


            }

            function fillForm(id) {

                $("input:hidden").val(id);
                $("input:text").val("");


            }



        })

        function mensaje(sessionId, id) {

            $("#messagesWrapper").html(`<div id="mensaje"  class="mensaje" style="position: absolute; bottom: 0; height: 100px; width: 100%" >

                </div>`)


            $.ajax({
                type: "GET",
                url: "https://api.ringbyname.com/sms/message?search=conversation.id:" + id,
                // headers: { "X-Session-Id" : sessionId},
                beforeSend: function (request) {
                    request.setRequestHeader("X-Session-Id", sessionId)
                },
                success: function (response) {
                    rows = response.data.rows
                    last_index = rows.length - 1;
                    convo_id = rows[last_index].conversation.id;
                    console.log(sessionId)

                    let date = new Date("2020-09-06 20:15:49");
                    let options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour12: false
                    }
                    let dateFormated = date.toLocaleString('default', options);
                    let time = date.toLocaleTimeString('en-US');

                    for (let y = 0; y < rows.length; y++) {
                        let mensaje = rows[y].message

                        let date = new Date(rows[y].date_created);
                        let options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour12: false
                        }
                        let dateFormated = date.toLocaleString('default', options);
                        let time = date.toLocaleTimeString('en-US');


                        inbound = rows[y].is_inbound ? "left" : "right"
                        backcolor = rows[y].is_inbound ? "lightgreen" : "lightblue"

                        $("#mensaje").before(
                            '<div class="col-6 mensaje" style="margin: 20px 10px; padding:20px 20px 10px 20px; clear:both; float:' +
                            inbound + '; border-radius: 35px 0px 35px 0px; -moz-border-radius: 35px 0px 35px 0px; -webkit-border-radius: 35px 0px 35px 0px; background-color: ' + backcolor + ' " >' + mensaje +
                            '<p style="margin: 15px 0 0 0; clear:both; color: gray; font-size: 14px; float: right">' +
                            dateFormated +
                            '</p><p style="margin: 0px 0 0 0; clear:both; color: gray; font-size: 14px; float: right">' +
                            time + '</p></div>')
                    }

                    $('#messagesWrapper').animate({
                        scrollTop: $('#messagesWrapper').prop("scrollHeight")
                    }, 2500);
                    $('#MovedWraper').animate({
                        left: 0
                    }, 1000);


                    fillForm(convo_id);
                }

            });


        }

        function fillForm(id) {

            $("input:hidden").val(id);
        }
    </script>
</body>

</html>