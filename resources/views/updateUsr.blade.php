<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />        
        <title>CRUD intel usuarios</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
        body {
            background-color: #F3F3F3;
        }
        .nav-intel {
            background-color: #0071C5;
            color: white;
        }
        .img-logo-intel {
            max-width: 60px !important;
            text-align: center;
            margin: 0 auto;
        }
        .btn-intel {
          background-color: #0071C5;
          color: white;
          border-radius: 0px;
        }
        .btn-right {
          float: right;
        }
        .nav-color {
          color: white;
        }
        .nav-color:hover {
          color: #6BBCE8;
        }
        body {
          font: tahoma, Helvetica;
          font-size: 16px;
        }
        </style>
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    </head>
    <body>

    <nav class="navbar fixed-top navbar-light nav-intel">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link nav-color" href="/">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-color" href="/cargaMasiva">Carga masiva</a>
        </li>
      </ul>
        <img class="img-fluid img-logo-intel" src="/images/intel-logo-highres.png" alt="">
    </nav>
    <br>
    <br>
    <br>

    <div class="container">
        <div class="card" style="width: 100%;">
          <div class="card-header">
            <h5>Actualizar datos</h5>
          </div>
          <div class="card-body">
            <!-- Por metodo post agregamos el usuario -->
            <form action="/updateUsuario" method="PUT">                
                <div class="row">
                  
                  <div class="">
                    <img width="200px;" class="img-thumbnail" src="/images/{{$usuario->urlImage}}" alt="imgUsuario">
                  </div>

                  <div class="col">
                    
                    <div class="row">
                      
                      <div class="col">
                        <div class="form-group">
                          <label for="upNombre">Nombre</label>
                          <input class="form-control" type="text" name="upNombre" id="upNombre" value="{{$usuario->nombre}}" required>
                          <input class="form-control" type="hidden" id="upId" value="{{$usuario->id}}" required>                        
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="upApellido">Apellido</label>
                          <input class="form-control" type="text" name="upApellido" id="upApellido" value="{{$usuario->apellido}}" required>
                        </div>
                      </div>
                    </div>


                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="upTelefono">Teléfono</label>
                            <input class="form-control" type="text" name="upTelefono" id="upTelefono" value="{{$usuario->telefono}}" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="upEdad">Edad</label>
                            <input class="form-control" type="number" step="1" min="0" name="upEdad" id="upEdad" value="{{$usuario->edad}}" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="upFIngreso">Fecha de ingreso</label>
                            <input class="form-control" type="date" name="upFIngreso" id="upFIngreso" value="{{$usuario->fechaIngreso}}" required>
                          </div>
                        </div>
                      </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col" >
                    <button class="btn btn-intel btn-right" onclick="UpdateUSerData()" type="button">Actualizar registro</button>
                  </div>
                </div>
            </form>    
          </div>
          <div class="card-footer text-muted">
            Actualizar los datos del usuario por metodo PUT
          </div>
        </div>
    </div>
    <br>


    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#dtRegistros').DataTable({
            "language": {
              "decimal":        "",
              "emptyTable":     "Sin registros",
              "info":           "Mostrando _START_ al _END_ de _TOTAL_ registros",
              "infoEmpty":      "Mostrando 0 al 0 de 0 entries",
              "infoFiltered":   "(filtered from _MAX_ total entries)",
              "infoPostFix":    "",
              "thousands":      ",",
              "lengthMenu":     "Muestra _MENU_ registros",
              "loadingRecords": "Cargando...",
              "processing":     "Procesando...",
              "search":         "Buscar:",
              "zeroRecords":    "No matching records found",
              "paginate": {
                  "first":      "Primero",
                  "last":       "Último",
                  "next":       "Siguiente",
                  "previous":   "Anterior"
                }
            }
        });
      });
    </script>


    <script>
    // Configuracion de la seguridad para usar metodo post
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function UpdateUSerData() {
      var id = $("#upId").val();
      var nombre = $("#upNombre").val();
      var apellido = $("#upApellido").val();
      var telefono = $("#upTelefono").val();
      var edad = $("#upEdad").val();
      var fechaIngreso = $("#upFIngreso").val();

      var registro = {
      "id":id, 
      "nombre":nombre, 
      "apellido": apellido,
      "telefono": telefono,
      "edad": edad,
      "fechaIngreso": fechaIngreso};

      $.ajax({
        type:"PUT",
        url: "/updateUsuario",
        data: registro,
        success: function(data) {
          alert(data.mensaje);
        },
        error: function() {
          alert("Error al actualizar los datos");
        }
      });
    }

    </script>


    </body>
</html>
