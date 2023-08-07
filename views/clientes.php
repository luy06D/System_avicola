<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- DataTable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <!-- Menu -->
        <nav class="navbar navbar-light bg-warning-subtle fixed-top">
            <div class="container-fluid ">
            <a class="navbar-brand" href="#"><img src="../img/remove.png" style="width: 50px;" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
              aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header bg-success-subtle">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="ventas.php">Ventas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="reportes.php">Reportes</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Cerrar sesión</a>
                    </li>
                </ul>
                
                </div>
            </div>
            </div>
        </nav>
    </header>
      
    <br><br><br><br>

    <!-- Tabla-Clientes -->
    <div class="container-lg table-responsive ">
        <h4 class="text-center">CLIENTES</h4>
        <hr>
        <button type="button" id="abrir-modal-registro" class="btn btn-primary btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-registrar">
            Nuevo
        </button>
        <div class="row">
            <div class="col-lg-12">
                <table id="tabla-cliente" class="table table-sm table-striped" >
                                
                    <thead class="table-secondary">
                        <tr>
                        <th>Código</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Operación</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div> 
    </div>



    <!-- Modal-Registrar  -->
    <div class="modal fade" id="modal-registrar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modal-registro-header">
                    <h5 class="modal-title" id="modal-titulo">Nuevo Cliente</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="form-clientes">
                    <div class="row">
                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-user' ></i></span>
                          <input type="text" class="form-control" placeholder="Nombres" maxlength="50" id="nombres">
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-user' ></i></span>
                          <input type="text" class="form-control" placeholder="Apellidos" maxlength="50" id="apellidos">
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-id-card'></i></span>
                          <input type="text" class="form-control" placeholder="Número DNI" maxlength="8" id="dni">
                        </div>  
                      </div>
                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-phone' ></i></span>
                          <input type="tel" class="form-control" placeholder="900-000-00" maxlength="9" id="telefono">
                        </div>  
                      </div>
                    </div>
                    </form>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AJAX = JavaScript asincrónico-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- datatable-->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>


    
    <script>
        $(document).ready(function (){

            let datosNuevos = true;
            let idpersona = 0; 

            function mostrar(){
                $.ajax({
                    url: '../controllers/clientes.controller.php',
                    type: 'GET',
                    data: {'operacion' : 'listar'},
                    success: function (result){

                        var tabla = $("#tabla-cliente").DataTable();
                        tabla.destroy();
                        $("#tabla-cliente tbody").html(result);
                        $("#tabla-cliente").DataTable({
                            responsive: true,
                            lengthMenu:[15,10,5],
                            language: {
                                url: '../js/Spanish.json'
                            }
                        }); 
                    }
                });
            }

            function registrar(){
                let datosEnviar = {

                'operacion'   : 'registrar',
                'nombres'     : $("#nombres").val(),
                'apellidos'   : $("#apellidos").val(),
                'dni'         : $("#dni").val(),
                'telefono'    : $('#telefono').val()
                };

                if(!datosNuevos){
                
                    datosEnviar['operacion'] = "actualizar";
                    datosEnviar['idpersona'] = idpersona;
                }

                if(confirm("¿Está seguro de realizar la operación?")){
                    $.ajax({
                        url:'../controllers/clientes.controller.php',
                        type: 'GET',
                        data: datosEnviar,
                        success: function(result){
                        
                            $("#form-clientes")[0].reset();

                            mostrar();

                            $("#modal-registrar").modal('hide');
                        }
                    });
                }
            }

            function eliminar(id){
                if (confirm("¿Está seguro de eliminar el registro?")){
                    $.ajax({
                        url: '../controllers/clientes.controller.php',
                        type: 'GET',
                        data: {
                            'operacion' : 'eliminar',
                            'idpersona' : id
                        },
                        success: function(){
                            mostrar();
                        }
                    });
                }
            }

            function mostrarDatos (id){

                $("#form-clientes")[0].reset();

                $.ajax({
                    url: '../controllers/clientes.controller.php',
                    type: 'GET',
                    data: {
                        'operacion' : 'obtener',
                        'idpersona' : id
                    },
                    dataType: 'JSON',
                    success: function (result){
                        $("#nombres").val(result.nombres);
                        $("#apellidos").val(result.apellidos);
                        $("#dni").val(result.dni);
                        $("#telefono").val(result.telefono);
                    }
                });

                $("#modal-titulo").html("Actualización de Cliente");
                $("#modal-registro-header").removeClass("bg-primary");
                $("#modal-registro-header").addClass("bg-success-subtle");
                $("#guardar").html("Actualizar");
                datosNuevos = false;
                $("#modal-registro-empleado").modal("show")
                
            }

            function abrirModalRegistro(){
                $("#modal-titulo").html("Registro de Cliente");
                $("#modal-registro-header").removeClass("bg-primary");
                $("#modal-registro-header").addClass("bg-info-subtle");
                $("#guardar").html("Guardar");
                datosNuevos =true;
            }

            $("#tabla-cliente tbody").on("click", ".eliminar", function (){
                idpersona = $(this).data("idpersona");
                eliminar(idpersona);
            });

            $("#tabla-cliente tbody").on("click", ".editar", function (){
                idpersona = $(this).data("idpersona");            
                mostrarDatos(idpersona);
            });

            $("#abrir-modal-registro").click(abrirModalRegistro);

            $("#guardar").click(registrar);
            mostrar();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>