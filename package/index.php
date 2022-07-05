<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="public/css/estilos.css?v=<?php echo(rand()); ?>">

    

    <title>Mascotas</title>
  </head>
  <body>
    <div class="container fondo">
        <h1 class="text-center">Lista de Agregar</h1>
        <h1 class="text-center">Mascotas</h1>

        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
                        <i class="bi bi-plus-circle-fill"></i> Crear
                        </button>
                </div>
            </div>
        </div>
        <br />
        <br />

        <div class="table-responsive">
           <table id="datos_usuario" class="table table-bordered table-striped">
             <thead>
                 <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Tipo Mascota</th>
                    <th>Adoptado</th>
                    <th>Dueno</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                 </tr>
             </thead>
         </table>
        </div>
 </div>

 <!--Modal--> 
 <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Mascota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
        <form method="POST" id="formulario" enctype="multipart/form-data">
            <div class="modal-content">
                    <div class="modal-body">
                    <label for="nombre">Ingrese nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                    <br /> 

                    <label for="mascota">Ingrese Mascota</label>
                    <input type="text" name="mascota" id="mascota" class="form-control">
                    <br /> 

                    <label for="adoptado">Ingrese Si es adoptado</label>
                    <input type="text" name="adoptado" id="adoptado" class="form-control">
                    <br />

                    <label for="dueno">Ingrese Dueño</label>
                    <input type="text" name="dueno" id="dueno" class="form-control">
                    <br />
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id_usuario" id="id_usuario">
                    <input type="hidden" name="operacion" id="operacion">
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
                    
                    
            </div>
        </div>
        </form>
      
      
    </div>
  </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script type="text/javascript">

    $(document).ready(function(){

      $("#botonCrear").click(function(){
        $("#formulario")[0].reset();
        $(".modal-title").text("Agregar Mascota");
        $("#action").val("Crear");
        $("#operacion").val("Crear");
        
      });
    
      var dataTable = $('#datos_usuario').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "obtener_registros.php", 
          type: "POST"
        },
        "columnsDefs":[
          {
          "targets": [0, 3, 4],
          "orderable": false,
          },
        ],

        "language": {
          "decimal": "",
          "emptyTable": "No hay registros",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infofiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando..",
          "processing": "Procesando...",
          "search": "Buscar: ",
          "zeroRecords": "Sin resultados econtrados",
          "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
          }
        }

      });
    

      $(document).on('submit', '#formulario', function(event){
        event.preventDefault();
        var  nombres = $('#nombre').val();
        var  mascota = $('#mascota').val();
        var  adoptado = $('#adoptado').val();
        var  dueno = $('#dueno').val();

          if(nombres != '' && mascota != '' && dueno != '') {
            $.ajax({
              url: "crear.php",
              method: "POST",
              data:new FormData(this),
              contentType: false,
              processData: false,
              success:function(data) {

                alert(data);
                $('#formulario')[0].reset();
                $('#modalUsuario').modal('hide');
                dataTable.ajax.reload();
              }
            });
          }else {
            alert("Algunos campos son obligatorios");
          }

      });

      //funcion Editar

        $(document).on('click', '.editar', function(){

          var id_usuario = $(this).attr("id");
          $.ajax({
            url:"obtener_registro.php",
            method: "POST",
            data:{id_usuario:id_usuario},
            dataType: "json",
            success:function(data)
            {
                //console.log(data);
                $('#modalUsuario').modal('show');
                $('#nombre').val(data.nombre);
                $('#mascota').val(data.mascota);
                $('#adoptado').val(data.adoptado);
                $('#dueno').val(data.dueno);
                $('.modal-title').text("Editar Usuario");
                $('#id_usuario').val(id_usuario);
                $('#action').val('Editar');
                $('#operacion').val('Editar');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
          })

        });

        //Funcionalidad de borrar

          $(document).on('click', '.borrar', function(){

            var id_usuario = $(this).attr("id");
            if(confirm("Estas seguro de borrar este registro: " + id_usuario)) 
            {
                  $.ajax({
                        url:"borrar.php",
                        method: "POST",
                        data:{id_usuario:id_usuario},
                        success:function(data)
                        {
                          alert(data);
                          dataTable.ajax.reload();
                        }

                  });
            }
            else {
              return false;
            }

          });

    });  

</script>
    
  </body>
</html>