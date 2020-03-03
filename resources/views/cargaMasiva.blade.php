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
        .btnRight {
          float: right;
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
        <img class="img-fluid img-logo-intel" src="images/intel-logo-highres.png" alt="">
    </nav>
    <br>
    <br>
    <br>


    <div class="container">
      <div class="card">
        <div class="card-header">
          <h4>Carga masiva por medio de excel</h4>
        </div>
        <div class="card-body">

          <form action="POST">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <input class="form-control" type="file" name="fileUpload" id="fileUpload">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <input type="button" class="btn btn-primary" id="upload" value="Carga masiva" onclick="Upload()" />
                </div>
              </div>
            </form>
          </div>

        </div>
        <div class="card-footer">
          <span>Podrás cargar todos los registros en metodo masivo, el excel tiene que ser
            con exteción XLSX.
          </span>
        </div>
      </div>
    </div>


  


    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>


<script>
  
  $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });

  function Upload() {
        var fileUpload = document.getElementById("fileUpload");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function (e) {
                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("Este navegador no soporta HTML5.");
            }
        } else {
            alert("Por favor selecciona un archivo excel valido.");
        }
    };
    
    function ProcessExcel(data) {
        var workbook = XLSX.read(data, { type: 'binary' });
        var firstSheet = workbook.SheetNames[0];
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);

        var datos = [];
        excelRows.forEach(d => {
          datos.push({ 
            "nombre": d.nombre,
            "apellido": d.apellido,
            "telefono": d.telefono,
            "edad": d.edad,
            "fechaIngreso": d.fechaIngreso,
          });
        });
        $.ajax({
            type: "POST",
            url: "/cargaMasivaDatos",
            data: { 'datos': JSON.stringify(datos) },
            success: function(data){
                alert(data.mensaje);
                location.reload(true);
            },
            error: function() {
              alert("Imposible cargar los registros masivos");
            }
        });

    }
  </script>


    </body>
</html>
