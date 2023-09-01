<?php
session_start();

if(!isset($_SESSION['segurity']) || $_SESSION['segurity']['login'] == false){
  header('Location:../index.php');
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insumos</title>
    <link rel="icon" href="../img/remove.ico">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- DataTable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
</head>
<body>

<style>
    body{
        font-family: 'Poppins', sans-serif;
        /* overflow: hidden; */
        position: relative;
        padding-bottom: 3em;
        min-height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed; 
    }
  </style>


<header>
    <nav class="navbar navbar-light bg-warning-subtle  fixed-top">
        <div class="container-fluid ">
        <a class="navbar-brand" href="#"><img src="../img/remove.png" style="width: 80px;" alt=""></a>     
        <div style="margin-inline-start: auto;"><i class="bi bi-person-fill"></i> <span style="margin-right: 1rem;"><?= $_SESSION['segurity']['nombres']?> <?= $_SESSION['segurity']['apellidos']?></span></div>         
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">            
            <div class="offcanvas-header bg-warning-subtle">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>            
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                 <li class="nav-item dropdown mt-2">
                    <a class="nav-link dropdown-toggle" style="font-size: 25px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Huevos
                   </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./ventas.php"><h5><i class="bi bi-cart4"></i> Ventas</a></h5></li>
                    <li><a class="dropdown-item" href="./reportes.php"><h5><i class="bi bi-filetype-pdf"></i> Reporte Ventas</h5></a></li> 
                    <li><a class="dropdown-item" href="./pagos.php"><h5><i class="bi bi-cash-coin"></i> Pagos</h5></a></li> 
                    <li><a class="dropdown-item" href="./reportes.pago.php"><h5><i class="bi bi-graph-up-arrow"></i> Reporte Pagos</h5></a></li>                   
                    </ul>
                </li>    
                <li class="nav-item dropdown mt-2">
                    <a class="nav-link dropdown-toggle" style="font-size: 25px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Complementos
                   </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./productos.php"><h5><i class="bi bi-egg"></i> Productos</a></h5></li>
                    <li><a class="dropdown-item" href="./clientes.php"><h5><i class="bi bi-people"></i> Clientes</h5></a></li> 
                    <li><a class="dropdown-item" href="./usuarios.php"><h5><i class="bi bi-person-gear"></i> Usuarios</h5></a></li>                  
                    </ul>
                </li>                                                        
                <li class="nav-item dropdown mt-2">
                <a class="nav-link dropdown-toggle" style="font-size: 25px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Almacén
                </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./insumos.php"><h5><i class="bi bi-truck"></i> Insumos</a></h5></li>
                    <li><a class="dropdown-item" href="./formulas.php"><h5><i class="bi bi-minecart-loaded"></i> Salida</h5></a></li> 
                    <li><a class="dropdown-item" href="./reportinsumoentrada.php"><h5><i class="bi bi-graph-down-arrow"></i> Reporte Entradas</h5></a></li>  
                    <li><a class="dropdown-item" href="./reportinsumosalida.php"><h5><i class="bi bi-graph-up-arrow"></i> Reporte Salidas</h5></a></li> 


                    </ul>
                </li>  
                <li class="nav-item mt-2">
                <a class="nav-link" href="./graficos.php"><h4><i class="bi bi-graph-up"></i> Gráficos</h4></a>
                </li>                     
                <li class="nav-item mt-5">
                <a class="nav-link" style="position:absolute; bottom: -0px; color:crimson" href="../controllers/usuario.controller.php?operation=destroy"><h4><i class="bi bi-box-arrow-left"></i> Cerrar sesión</h4></a>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </nav>
  </header>
      
    <br><br><br><br><br>

    <!-- Tabla-Clientes -->
    <div class="container-lg table-responsive ">
        <h4 class="text-center">INSUMOS</h4>
        <hr>
        <button type="button" id="abrir-modal-registro" class="btn btn-success btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-registrar">
        <i class="bi bi-plus-circle"></i> Nuevo
        </button>
        <div class="row">
            <div class="col-lg-12">
                <table id="tabla-insumos" class="table table-sm table-striped" >
                                
                    <thead class="">
                        <tr>
                        <th>Código</th>
                        <th>Insumo</th>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Operaciones</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div> 

   
    </div>



    <!-- Modal-Registrar insumos  -->
    <div class="modal fade" id="modal-registrar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modal-registro-header" >
                    <h5 class="modal-title" id="modal-titulo">Nuevo Insumo</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="form-insumo">
                    <div class="row">
                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-minecart-loaded"></i></span>
                          <input type="text" class="form-control" placeholder="Nombre"  id="nombre">
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                                <select class="form-select" id="unidad" disabled>
                                <option value="">Seleccione</option>    
                                <option value="KG">KILOS</option>    
                                <option selected value="TN">TONELADAS</option>                 
                                </select>                
                                <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add' ></i></label>
                        </div>                     
                      </div>
                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-id-card'></i></span>
                          <input type="number" class="form-control" placeholder="Cantidad"  id="cantidad" disabled>
                        </div>  
                      </div>
                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-text-left"></i></span>
                        <input class="form-control" id="descripcion" placeholder="Descripcion" aria-label="With textarea"></input>
                        </div>                      
                      </div>
                    </div>
                    </form>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="" id="guardar">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-registrar-insu" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success" id="modal-registro-header">
                    <h5 class="modal-title text-white" id="modal-titulo">Agregar a Stock</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="form-pagos">
                        <!-- <div class="input-group mb-3">
                            <select class="form-select" id="unidad">
                            <option selected>Seleccione</option>    
                            <option value="KG">KILOS</option>    
                            <option value="TN">TONELADAS</option>                 
                            </select>                
                            <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add' ></i></label>
                        </div> -->
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-square"></i></span>
                          <input type="number" class="form-control" placeholder="Ingrese número de toneladas" maxlength="50" id="md-cantidad">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-square"></i></span>
                          <input type="number" class="form-control" placeholder="Ingrese número de sacos" maxlength="50" id="md-sacos">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-coin"></i></span>
                          <input type="number" class="form-control" placeholder="S/00.00" maxlength="50" id="md-precio">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-event"></i></span>
                          <input type="date" class="form-control"  id="md-fecha">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-chat-left-text"></i></span>
                          <input class="form-control"  rows="3" id="md-detalle"></input>
                        </div>
              
                    </form>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" id="guardarinsu">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <h6 style="text-align: center; position:absolute; bottom:0; width:100%; padding:1em 0; background: #B6B9B9  ; opacity:90%"><img src="../img/3plogo.png" style="width: 40px;" alt=""><a href="https://www.facebook.com/3p.ingenieriaytecnologia"> <img width="25" height="25" src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook-new"/><a href="https://wa.me/962734821"><img width="30" height="30" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/></a></h6>
    </footer>

    

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AJAX = JavaScript asincrónico-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- datatable-->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- opcional-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- <script src="../js/addstock.js"></script> -->

    <script>
        $(document).ready(function(){

            let sendData = true;
            let idinsumo = 0;

            function showInsumos(){
                $.ajax({
                    url: '../controllers/insumos.controller.php',
                    type: 'GET',
                    data: {'operacion' : 'showInsumos'},
                    success: function (result){
                        var table = $("#tabla-insumos").DataTable();
                        table.destroy();
                        $("#tabla-insumos tbody").html(result);
                        $("#tabla-insumos").DataTable({
                            responsive: true,
                            lengthMenu:[10,5],
                            language: {
                                url: '../js/Spanish.json'
                            }

                        });

                    }
                });
            }

            

            function registrarinsu() {
               console.log("id",idinsumo)
                Swal.fire({
                    title: '¿Está seguro de realizar la operación?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3F974F',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.isConfirmed) {                        
                        const cantidadtn = $("#md-cantidad").val();
                        const cantidadsaco = $("#md-sacos").val();
                        const precio = $("#md-precio").val();
                        const fecha = $("#md-fecha").val();
                        const detalle = $("#md-detalle").val();

                        if (cantidad === "" || fecha ==="") {
                            Swal.fire({
                                title: "Por favor, complete los campos y asegúrese de que la cantidad no esté vacía.",
                                icon: "warning",
                                confirmButtonColor: "#E43D2C",
                            });
                        } else {
                            let datosEnviar = {
                                'operacion': 'actualizar_stock',
                                'idinsumo': idinsumo,
                                'cantidadtn': cantidadtn,
                                'cantidadsacos': cantidadsaco,
                                'precio': precio,
                                'fecha_entrada': fecha,
                                'detalle': detalle,
                            };

                            $.ajax({
                                url: '../controllers/insumos.controller.php',
                                type: 'POST',
                                data: datosEnviar,
                                success: function (result) {
                                    console.log("relsutado", result)
                                    if (result.status === true) {
                                        Swal.fire({
                                            title: "Operación exitosa",
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });

                                        $("#form-pagos")[0].reset();
                                        showInsumos();
                                        $("#modal-registrar-insu").modal('hide');
                                    } else {
                                        Swal.fire({
                                            title: "No se pudo completar la operación",
                                            icon: "error",
                                            confirmButtonColor: "#E43D2C",
                                        });
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error("Error en la solicitud AJAX:", error);
                                    Swal.fire({
                                        title: "Error en la solicitud AJAX",
                                        icon: "error",
                                        confirmButtonColor: "#E43D2C",
                                    });
                                }
                            });
                        }
                    }
                });
            }


            function insumoRegister(){
                console.log("id",idinsumo)
                const nombre = document.querySelector("#nombre").value.trim();
                const unidad = document.querySelector("#unidad").value.trim();
                const cantidad = document.querySelector("#cantidad").value.trim();

                

                let sendData = {
                    'operacion': 'insumosRegister',
                    'insumo' : $("#nombre").val(),
                    'unidad' : $("#unidad").val(),
                    'cantidad' : $("#cantidad").val(),
                    'descripcion' : $("#descripcion").val(),
                };

                if(!sendDataNuevos){
                    sendData['operacion'] = "insumosUpdate";
                    sendData['idinsumo'] = idinsumo;
                }

                

                Swal.fire({
                    title: '¿Está seguro de realizar la operación?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3F974F',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.isConfirmed) {
                        if(nombre === ''){
                            Swal.fire({
                                title: "Por favor, complete los campos",
                                icon: "warning",
                                confirmButtonColor: "#E43D2C",
                            });
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Operación exitosa',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $.ajax({
                                url: '../controllers/insumos.controller.php',
                                type: 'POST',
                                data: sendData,
                                success: function (result) {
                                    $("#form-insumo")[0].reset();
                                        showInsumos();
                                    $("#modal-registrar").modal('hide');

                                    let resultado = JSON.parse(result);

                                    if(resultado.status === false){
                                        Swal.fire({
                                        title: "Este insumo ya esta registrado",
                                        icon: "warning",
                                        confirmButtonColor: "#E43D2C",
                                        timer: 1500
                                    });
                                    

                                    }
         
                                    
                                }

                            });
                        }
                    }
                });
            }

            function deleteInsumos(id) {
                Swal.fire({
                    title: '¿Está seguro de eliminar el registro?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../controllers/insumos.controller.php',
                            type: 'GET',
                            data: {
                                'operacion': 'eliminar',
                                'idinsumo': id
                            },
                            success: function () {
                                showInsumos();
                            }
                        });
                    }
                });
            }

    
            function getInsumos(id){
                $.ajax({
                    url: '../controllers/insumos.controller.php',
                    type: 'POST',
                    data: {
                        'operacion' : 'getInsumo',
                        'idinsumo' : id
                    },
                    dataType: 'JSON',
                    success: function (result){
                        $("#nombre").val(result.insumo);
                        $("#cantidad").val(result.cantidad);
                        $("#unidad").val(result.unidad);
                        $("#descripcion").val(result.descripcion);
                    }
                });

                $("#modal-titulo").html("Actualización de Insumo"); 
                $("#modal-titulo").removeClass("text-white");                
                $("#modal-registro-header").removeClass("bg-primary");
                $("#modal-registro-header").addClass("bg-warning");
                 $("#guardar").addClass("btn btn-outline-warning");
                $("#guardar").html("Actualizar");

                // $("#cantidad").prop("disabled", true);
                sendDataNuevos = false;
                $("#modal-registrar").modal("show")
            }
            
            function abrirModalRegistro(){
                $("#modal-titulo").html("Registro de Insumos");
                $("#modal-titulo").addClass("text-white");
                $("#modal-registro-header").removeClass("bg-warning");
                $("#modal-registro-header").addClass("bg-success");
                $("#guardar").html("Guardar");
                $("#guardar").removeClass("btn btn-outline-warning");
                $("#guardar").addClass("btn btn-outline-success");
                
                $("#form-insumo")[0].reset();
                sendDataNuevos =true;
            }

            $("#tabla-insumos tbody").on("click", ".eliminar", function (){
                idinsumo = $(this).data("idinsumo");            
                deleteInsumos(idinsumo);
            });

            $("#tabla-insumos tbody").on("click", ".editar", function (){
                idinsumo = $(this).data("idinsumo");            
                getInsumos(idinsumo);
            });

            $("#tabla-insumos tbody").on("click", ".add", function () {
                idinsumo = $(this).data("idinsumo");
            });

            $("#guardarinsu").click(registrarinsu);

            // Cuando se cierre el modal, resetear el valor de idinsumo
            $("#modal-registrar").on("hidden.bs.modal", function () {
                idinsumo = 0;
            });


            $("#abrir-modal-registro").click(abrirModalRegistro);
           
            $("#guardar").click(insumoRegister);

            

            

            showInsumos();
        });
    </script>
    


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



</body>
</html>

