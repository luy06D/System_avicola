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
    <title>Pagos</title>
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
    <link rel="stylesheet" href="../styles/pago.css">

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

        <h4 class="text-center">PAGOS</h4>
        <hr>

        
                
        <div class="row">
            <div class="col-lg-12">
                <table id="tabla-pago" class="table table-sm table-striped" >
                                
                    <thead class="table-secondary">
                        <tr>
                        <th>Codigo</th>
                            <th>Cliente</th>
                            <th>Fecha venta</th>
                            <th>Deuda Total</th>
                            <th>Pago</th>
                            <th>Saldo</th>
                            <th>Estado</th>
                            <th>Operacion</th>
                            
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
                    <h5 class="modal-title" id="modal-titulo">Registrar pago</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="form-pagos">
              
                        <div class="input-group mb-3">
                        <select  class="form-select "  id="banco" style="width: 100%;" >
                        <option value="" disabled selected>
                             Seleccione
                        </option>
                        <option value="BCP">BCP</option>
                        <option value="SCOTIABANK">SCOTIABANK</option>
                        <option value="BANCO LA NACION">BANCO LA NACION</option>
                        <option value="BBVA">BBVA</option>
                        <option value="BANBIF">BANBIF</option>
                        <option value="PICHINCHA">PICHINCHA</option>
                        <option value="INTERBANK">INTERBANK</option>
                        <option value="YAPE">YAPE</option>
                        <option value="PLIN">PLIN</option>
                        <option value="Otros">Otros</option>
                    </select>
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-square"></i></span>
                          <input type="text" class="form-control" placeholder="N-Operacion" maxlength="20" id="numoperacion">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-square"></i></span>
                          <input type="number" class="form-control" placeholder="Pago" maxlength="50" id="pago">
                        </div>
              
                        <!-- <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-database"></i></span>
                          <input type="number" class="form-control" placeholder="Cantidad"  id="cantidad" min="1" max="500">
                        </div> -->
                    </form>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
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

    
<script src="../js/registrarpago.js"></script>

    <script>
        $(document).ready(function (){

let datosNuevos = true;
let idventa = 0; 

function mostrar(){
    $.ajax({
        url: '../controllers/pagos.controller.php',
        type: 'GET',
        data: {'operacion' : 'listar'},
        success: function (result){

            var tabla = $("#tabla-pago").DataTable();
            tabla.destroy();
            $("#tabla-pago tbody").html(result);
            $("#tabla-pago").DataTable({
                responsive: true,
                lengthMenu:[5],
                language: {
                    url: '../js/Spanish.json'
                }
            }); 

            // Cambiar color de fondo del estado según el saldo
            $("#tabla-pago tbody tr").each(function() {
                const saldo = parseFloat($(this).find("td:nth-child(6)").text());
                const estadoCell = $(this).find("td:nth-child(7)");

                if (saldo === 0) {
                    estadoCell.html('<span class="badge bg-success text-white">Cancelado</span>');
                } else {
                    estadoCell.html('<span class="badge bg-danger text-white">Pendiente</span>');
                }
            });
        }
    });
}

            function registrar() {
    Swal.fire({
        title: '¿Está seguro de realizar la operación?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#65BB3B',
    }).then((result) => {
        if (result.isConfirmed) {
            const banco = $("#banco").val().trim();
            const numoperacion = $("#numoperacion").val().trim();
            const pago = $("#pago").val().trim();

            if (banco === '' || numoperacion === '' || pago === '' || parseFloat(pago) === 0) {
                Swal.fire({
                    title: "Por favor, complete los campos y asegúrese de que el pago no sea cero.",
                    icon: "warning",
                    confirmButtonColor: "#E43D2C",
                });
            } else {
                let datosEnviar = {
                    'operacion': 'registrar',
                    'idventa': idventa,
                    'banco': banco,
                    'numoperacion': numoperacion,
                    'pago': pago
                };

                $.ajax({
                    url: '../controllers/pagos.controller.php',
                    type: 'POST',
                    data: datosEnviar,
                    success: function (result) {
                        if (result.status === true) {
                            Swal.fire({
                                title: "Operación exitosa",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $("#form-pagos")[0].reset();
                            mostrar();
                            $("#modal-registrar").modal('hide');
                        } else {
                            Swal.fire({
                                title: "Número de operación duplicado",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
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










    $("#tabla-pago tbody").on("click", ".abonar", function () {
        idventa = $(this).data("idventa");
    });

        
            
            $("#guardar").click(registrar);
            
            mostrar();
            
            
        });
    </script>
    <!--procediminetos-->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>