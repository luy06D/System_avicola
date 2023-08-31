<?php
session_start();

if(!isset($_SESSION['segurity']) || $_SESSION['segurity']['login'] == false){
  header('Location:../index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
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
                    <li><a class="dropdown-item" href="./formulas.php"><h5><i class="bi bi-minecart-loaded"></i> Formulas</h5></a></li> 
                    <li><a class="dropdown-item" href="./reportinsumoentrada.php"><h5><i class="bi bi-graph-down-arrow"></i> Entradas</h5></a></li>  
                    <li><a class="dropdown-item" href="./reportinsumosalida.php"><h5><i class="bi bi-graph-up-arrow"></i> Salidas</h5></a></li> 

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

    <!-- Tabla-Productos -->
    <div class="container-lg table-responsive ">

        <h4 class="text-center">PRODUCTOS</h4>
        <hr>
        <button type="button" id="abrir-modal-registro" class="btn btn-success btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-registrar">
        <i class="bi bi-plus-circle"></i>  Nuevo
        </button>
        
                
        <div class="row">
            <div class="col-lg-12">
                <table id="tabla-producto" class="table table-sm table-striped" >
                                
                    <thead class="table-secondary">
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <!-- <th>Cantidad</th> -->
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
                    <h5 class="modal-title" id="modal-titulo">Nuevo Producto</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="form-productos">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-cart-plus"></i></span>
                          <input type="text" class="form-control" placeholder="Nombre producto" maxlength="50" id="producto">
                        </div>
              
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-square"></i></span>
                          <input type="text" class="form-control" placeholder="Descripción" maxlength="50" id="descripcion">
                        </div>
              
                        <!-- <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-database"></i></span>
                          <input type="number" class="form-control" placeholder="Cantidad"  id="cantidad" min="1" max="500">
                        </div> -->
                    </form>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="" id="guardar">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <h6 style="text-align: center; position:absolute; bottom:0; width:100%; padding:1em 0; background: #B6B9B9  ; opacity:80%"><img src="../img/3plogo.png" style="width: 40px;" alt=""><a href="https://www.facebook.com/3p.ingenieriaytecnologia"> <img width="25" height="25" src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook-new"/><a href="https://wa.me/962734821"><img width="30" height="30" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/></a></h6>
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
    
    <script>
        $(document).ready(function (){

            let datosNuevos = true;
            let idproducto = 0; 

            function mostrar(){
                $.ajax({
                    url: '../controllers/productos.controller.php',
                    type: 'GET',
                    data: {'operacion' : 'listar'},
                    success: function (result){

                        var tabla = $("#tabla-producto").DataTable();
                        tabla.destroy();
                        $("#tabla-producto tbody").html(result);
                        $("#tabla-producto").DataTable({
                            responsive: true,
                            lengthMenu:[10,5],
                            language: {
                                url: '../js/Spanish.json'
                            }
                        }); 
                    }
                });
            }


            function registrar() {
                const nombre = document.querySelector("#producto").value.trim();            
                // const descripcion = document.querySelector("#descripcion").value.trim();

                let datosEnviar = {
                    'operacion': 'registrar',
                    'nombre': $("#producto").val(),
                    'descripcion': $("#descripcion").val(),
                    // 'cantidad': $("#cantidad").val(),
                };

                if (!datosNuevos) {
                    datosEnviar['operacion'] = "actualizar";
                    datosEnviar['idproducto'] = idproducto;
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

                        }else{
                            Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Operación exitosa',
                        showConfirmButton: false,
                        timer: 1500
                        })

                        $.ajax({
                            url: '../controllers/productos.controller.php',
                            type: 'GET',
                            data: datosEnviar,
                            success: function (result) {
                                $("#form-productos")[0].reset();
                                mostrar();
                                $("#modal-registrar").modal('hide');
                            }
                        });

                        }
                
                    }
                });
            }



            function eliminar(id) {
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
                            url: '../controllers/productos.controller.php',
                            type: 'GET',
                            data: {
                                'operacion': 'eliminar',
                                'idproducto': id
                            },
                            success: function () {
                                mostrar();
                            }
                        });
                    }
                });
            }


            function mostrarDatos (id){

                $("#form-productos")[0].reset();

                $.ajax({
                    url: '../controllers/productos.controller.php',
                    type: 'GET',
                    data: {
                        'operacion' : 'obtener',
                        'idproducto' : id
                    },
                    dataType: 'JSON',
                    success: function (result){
                        $("#producto").val(result.nombre);
                        $("#descripcion").val(result.descripcion);
                        // $("#cantidad").val(result.cantidad);
                    }
                });

                $("#modal-titulo").html("Actualización de productos"); 
                $("#modal-titulo").removeClass("text-white");                
                $("#modal-registro-header").removeClass("bg-primary");
                $("#modal-registro-header").addClass("bg-warning");
                 $("#guardar").addClass("btn btn-outline-warning");
                $("#guardar").html("Actualizar");
                datosNuevos = false;
                $("#modal-registrar").modal("show")
                
            }

            function abrirModalRegistro(){
                $("#modal-titulo").html("Registro de productos");
                $("#modal-titulo").addClass("text-white");
                $("#modal-registro-header").removeClass("bg-warning");
                $("#modal-registro-header").addClass("bg-success");
                $("#guardar").html("Guardar");
                $("#guardar").removeClass("btn btn-outline-warning");
                $("#guardar").addClass("btn btn-outline-success");
                $("#form-productos")[0].reset();
                datosNuevos =true;
            }

            $("#tabla-producto tbody").on("click", ".eliminar", function (){
                idproducto = $(this).data("idproducto");
                eliminar(idproducto);
            });

            $("#tabla-producto tbody").on("click", ".editar", function (){
                idproducto = $(this).data("idproducto");            
                mostrarDatos(idproducto);
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