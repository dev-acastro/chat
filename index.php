
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chat TopDental</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">




</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin: 0" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Mensajes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Mensajes RingByName</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="Mensajes" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Contacto</th>
                      <th>Telefono</th>
                      <th>Fecha</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Contacto</th>
                      <th>Telefono</th>
                      <th>Fecha</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
            <div class="col-6" style="height: 80vh; border: 1px solid lightgrey;">
            <div id="messagesWrapper" class="col-12" style=" height: 70vh; overflow-y: scroll">
            </div>
            <div class="col-12" style="width: 100%; height: 100px; ">
            <form id="enviar" >
                <input type="text"  name="message" style="width: 80%; padding: 20px 30px; margin: 10px; ">
                <input id="message_id" type="hidden"  name="convo_id" value="" >
                <input  class="btn btn-primary" type="submit" style="width: 10%">
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
<!-- ./wrapper -->

<!-- jQuery -->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="dist/js/ajax.js"></script>


<!-- page script
<script>

    $(function(){
        $('#Mensajes').DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

</script> -->
<script>

    function mensaje(sessionId, id ){

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
    }




</script>
</body>
</html>
