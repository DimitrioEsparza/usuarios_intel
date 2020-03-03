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
            <h5>Agregar nuevo usuario</h5>
          </div>
          <div class="card-body">
            <!-- Por metodo post agregamos el usuario -->
            <form action="/addUsuario" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="inputImg">Foto</label>
                        <input class="form-control" type="file" name="inputImg" id="inputImg">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="inputNombre">Nombre</label>
                        <input class="form-control" type="text" name="inputNombre" id="inputNombre" required>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="inputApellido">Apellido</label>
                        <input class="form-control" type="text" name="inputApellido" id="inputApellido" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="inputTelefono">Teléfono</label>
                      <input class="form-control" type="text" name="inputTelefono" id="inputTelefono" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="inputEdad">Edad</label>
                      <input class="form-control" type="number" step="1" min="0" name="inputEdad" id="inputEdad" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="inputFIngreso">Fecha de ingreso</label>
                      <input class="form-control" type="date" name="inputFIngreso" id="inputFIngreso" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col" >
                    <button class="btn btn-intel btn-right" type="submit">Guardar registro</button>
                  </div>
                </div>
            </form>    
          </div>
        </div>
    </div>
    <br>

    <div class="container">
      <div class="card">
        <div class="card-body">
          <table class="table" id="dtRegistros">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Edad</th>
                <th>Fecha de ingreso</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach($usuarios as $usuario)
              <tr >
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->nombre}}</td>
                <td>{{$usuario->apellido}}</td>
                <td>{{$usuario->telefono}}</td>
                <td>{{$usuario->edad}}</td>
                <td>{{$usuario->fechaIngreso}}</td>
                <td>
                  <a href="/updateUsuario/{{$usuario->id}}" class="btn btn-success btn-sm">Actualizar</a>
                  <button class="btn btn-danger btn-sm" onclick="eliminar({{$usuario->id}})" >Eliminar</button>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
      </div>
    </div>


  


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

    // Por metodo delete eliminamos el usuario por id
    function eliminar(id) {
        $.ajax({
            type: "delete",
            url: "/deleteUsuario",
            data: "id="+ id,
            success: function(data){
                alert(data.mensaje);
                location.reload(true);
            },
            error: function() {
              alert("Imposible eliminar el registro, por favor comunicarse a sistemas");
            }
        });
    };

    // Por metodo get obtenemos los datos del usuario
    function ObtieneDatosUsuario(id) {
      $.ajax({
            type: "get",
            url: "/searchUsuario",
            data: "id="+ id,
            success: function(data){
              debugger;
              $("#upId").val(data.id);
              $("#upNombre").val(data.nombre);
              $("#upApellido").val(data.apellido);
              $("#upTelefono").val(data.telefono);
              $("#upEdad").val(data.edad);
              $("#upFIngreso").val(data.fechaIngreso);
              $("#modalGetUserData").modal("show");
            },
            error: function() {
              alert("Imposible obtener los datos del usuario, favor de comunicarse a sistemas");
            }
        });
    }


    function OcultaModal() {
      $("#upNombre").val("");
      $("#upApellido").val("");
      $("#upTelefono").val("");
      $("#upEdad").val("");
      $("#upFIngreso").val("");
      $("#modalGetUserData").modal("hide");
    }


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
          debugger;
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
