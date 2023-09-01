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
    <title>Reportes pagos</title>
    <link rel="icon" href="../img/remove.ico">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<!-- DataTable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/datatables.css" rel="stylesheet">
        <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

      <!-- estilos de select2   -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
</head>

<body>
<style>
       body{
        font-family: 'Poppins', sans-serif;
        position: relative;
        padding-bottom: 3em;
        min-height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed; 
        }

        /* Estilo para los paquetes */
#conten_paquetes ul {
  list-style: none;
  padding: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 10px;
}

#conten_paquetes li {
  flex-basis: calc(33.33% - 10px); /* Tres columnas con espacio entre ellas */
  background-color: #f2f2f2;
  border: 1px solid #ddd;
  padding: 10px;
  border-radius: 5px;
}

/* Estilo para hacerlo responsive en dispositivos pequeños */
@media (max-width: 768px) {
  #conten_paquetes ul {
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 20px;
  }

  #conten_paquetes li {
    flex-basis: calc(33.33% - 10px); /* Tres columnas con espacio entre ellas */
  }
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

    <main class="opacity-85 mb-5">
        <div class="container mt-5 col-12">
            <div class="card">
                <div class="card-header bg-light-subtle text-black">
                    <h4 class="text-center">FILTRADO PAGOS</h4>
                </div>
                <div class="card-body" >
                    <form action="" id="form-filtro">
                        <div class="row">

                            <div class=" col-lg-3">
                                <div>   
                                    <label for="cliente" class="form-label">Cliente:</label>                                 
                                    <select  id="cliente" class="js-example-responsive" style="width: 100%;" >
                                    <option value=""></option>
                                    </select>
                                </div>                               
                            </div>
                            <div class=" col-lg-3">
                                <div class="input-group mt-4">
                                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' ></i></span>
                                    <input type="date" class="form-control"  id="fechainicio">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-group  mt-4">
                                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' ></i></span>
                                    <input type="date" class="form-control"  id="fechafin">
                                </div>
                            </div>
                            <div class="col-md-3 mt-4">
                                <div class="">
                                    <button id="btnfiltro" class="btn btn-success btn-md " type="button"><i class="bi bi-funnel-fill"></i></button>
                                    <button id="exportar" class="btn btn-danger" type="button"><i class="bi bi-file-earmark-pdf"></i></button>
                                    <button id="reset" class="btn btn-secondary" type="button"><i class="bi bi-arrow-counterclockwise"></i> Limpiar</button>
                                </div>
                            </div>                     
                            
                        </div>
                    </form>
          
                </div>
              
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <table class="table display nowrap" style="width: 100%;"  id="table-report">
                        <thead class="table-success text-center">
                            <tr>
                                <th class='d-none'>Código</th>
                                <th class="d-none">Código Cl</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th class='d-none'>Producto</th>
                                <th>Deuda total</th>
                                <th>Pago total</th>
                                <th>Saldo</th>
                                <th>Estado</th>   
                                <th>Operación</th>            
                            </tr>
                        </thead>
                        <tbody>
                        <!-- DATOS ASINCRONOS  -->
                        </tbody>
                    </table>
                </div>
            </div>
      
        </div>
    </main>


    
    
    <!-- MODAL DETALLES -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #9ACD32;">
                    <h5 class="modal-title text-black" style="text-align: center;" id="modalTitleId">HISTORIAL DE PAGOS</h5>
                </div>
                <div class="modal-body">

                <div class="row mt-3">
                <div class="col-lg-12">
                    <form action="" id="form-detalles">

                        <table class="table display nowrap" style="width: 100%;"  id="table-detalles">
                            <thead class="table-secondary text-center">
                                <tr>
                                    <th class='d-none'>Id</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th class='d-none'>Producto</th>
                                    <th>Banco</th>
                                    <th>N° operación</th>
                                    <th>Pago</th>          
                                </tr>
                            </thead>
                            <tbody id="detallescuerpo">
                            <!-- DATOS ASINCRONOS  -->
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <!-- <button id="exportard" class="btn btn-danger" type="button"><i class="bi bi-file-earmark-pdf"></i></button> -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
    
    
    

    

    <footer>
        <h6 style="text-align: center; position:absolute; bottom:0; width:100%; padding:1em 0; background: #B6B9B9  ; opacity:80%"><img src="../img/3plogo.png" style="width: 40px;" alt=""><a href="https://www.facebook.com/3p.ingenieriaytecnologia"> <img width="25" height="25" src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook-new"/><a href="https://wa.me/962734821"><img width="30" height="30" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/></a></h6>
    </footer>
    
    
   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

     <!-- CDN sweetAlert2 -->
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
     <!-- AJAX = JavaScript asincrónico-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    

    <!-- datatable-->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- opcional-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

       <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <!-- Datatable for BS5 - Para los botones se debe agregar nuevas librerías -->
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>

    <script src="../js/verdetalles.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () =>{

              //Activa el select2 en clientes
             $("#cliente").select2();

            const cuerpoTabla = document.querySelector("#table-report tbody");
            const cuerpoTabla2 = document.querySelector("#detallescuerpo");
            const btnfiltro = document.querySelector("#btnfiltro");
            const btnExportar = document.querySelector("#exportar");
            const btnPDF = document.querySelector("#exportard");
            const lsCliente = document.querySelector("#cliente");
            const btnReset = document.querySelector("#reset");
            const formupa = document.querySelector("#formulariopaquetes div");
            // const modal = new bootstrap.Modal(document.querySelector("#modal-registrar"));
            
            function recuperarCliente(){
            const parameters = new URLSearchParams();
            parameters.append("operacion", "recuperarCliente");

            fetch("../controllers/reportes.pago.controller.php", {
                method: 'POST',
                body: parameters
            })
            .then(response => response.json())
            .then(data => {
                lsCliente.innerHTML = "<option value=''>Seleccione</option>";
                data.forEach(element => {
                const optionTag = document.createElement("option");
                optionTag.value = element.idcliente
                optionTag.text = element.clientes;
                lsCliente.appendChild(optionTag);
                
                });
            });
            }



            function filtropagofecha(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "filtropagofechas");
                parameters.append("fechainicio", document.querySelector("#fechainicio").value);
                parameters.append("fechafin", document.querySelector("#fechafin").value);

                fetch(`../controllers/reportes.pago.controller.php`, {
                    method: 'POST',
                    body: parameters
                })
                .then(response => response.json())
                .then(data => {        

                    if(data.length === 0){                        
                    Swal.fire({
                        title: "No hay registros",
                        icon: "warning",
                        confirmButtonColor: "#E43D2C",
                     });
                    
                    }else{
                    cuerpoTabla.innerHTML = ``;
                    data.forEach(element => {
                        let estadoHTML = '';

                        // Verificar el estado y establecer el color de fondo correspondiente
                        if (element.estado === 'Pendiente') {
                            estadoHTML = `<span class="badge bg-danger text-white">${element.estado}</span>`;
                        } else if (element.estado === 'Cancelado') {
                            estadoHTML = `<span class="badge bg-success text-white">${element.estado}</span>`;
                        } else {
                            estadoHTML = `<span class="badge bg-primary">${element.estado}</span>`;
                        }
                        const rows = `
                        <tr>
                            <td class='d-none'>${element.idpago}</td>
                            <td class='d-none'>${element.idcliente}</td>
                            <td>${element.cliente}</td>
                            <td>${element.fechapago}</td>
                            <td class='d-none'>${element.producto}</td>
                            <td>${element.deuda_total}</td>
                            <td>${element.pago_total}</td>
                            <td>${element.saldo}</td>      
                            <td>${estadoHTML}</td>
                            <td>
                                <a href='#' class='mostrar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modalId' data-idcliente='${element.idcliente}'><i class="bi bi-eye"></i></a>
                            </td>
                            

                        </tr>
                        `;
                        cuerpoTabla.innerHTML += rows;                        
                    });

                    $("#modalId").on("hidden.bs.modal", function () {
                        cuerpoTabla2.innerHTML = ''; // Vaciar el contenido del cuerpo de la tabla
                    });

                    

                    // Destruir la instancia actual de DataTables
                    if ($.fn.DataTable.isDataTable('#table-report')) {
                        $('#table-report').DataTable().destroy();
                    }

                    $(document).ready(function(){                                   
                        $('#table-report').DataTable({
                            responsive: true ,
                            lengthMenu:[10,5],
                            language: {
                                url: '../js/Spanish.json'
                            },
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excel',
                                    text: '<i class="bi bi-file-excel"></i>',
                                    titleAttr:'Exportar a excel',
                                    title:'REPORTES PAGOS',
                                    className:'btn btn-success',
                                    exportOptions:{ columns: [1,2,3,4,5,6,7] }
                                },                            
                                {
                                    extend: 'print',
                                    text: '<i class="bi bi-printer"></i>',
                                    titleAttr:'imprimir',
                                    title:'REPORTES PAGOS',
                                    className:'btn btn-secondary',
                                    exportOptions:{ columns: [1,2,3,4,5,6,7] }
                                }
                            ],
                            
                        });
                    })

                    }           
           
                })                            
            }

            function filtropagofechacliente(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "filtropagofechacliente");
                parameters.append("fechainicio", document.querySelector("#fechainicio").value);
                parameters.append("fechafin", document.querySelector("#fechafin").value);
                parameters.append("idcliente", parseInt(lsCliente.value));

                fetch(`../controllers/reportes.pago.controller.php`, {
                    method: 'POST',
                    body: parameters
                })
                .then(response => response.json())
                .then(data => {
                    if(data.length === ""){                        
                    Swal.fire({
                        title: "No hay registros",
                        icon: "warning",
                        confirmButtonColor: "#E43D2C",
                     });
                    
                    }else{
                        cuerpoTabla.innerHTML = ``;
                        data.forEach(element =>{
                            let estadoHTML = '';

                            // Verificar el estado y establecer el color de fondo correspondiente
                            if (element.estado === 'Pendiente') {
                                estadoHTML = `<span class="badge bg-danger text-white">${element.estado}</span>`;
                            } else if (element.estado === 'Cancelado') {
                                estadoHTML = `<span class="badge bg-success text-white">${element.estado}</span>`;
                            } else {
                                estadoHTML = `<span class="badge bg-primary">${element.estado}</span>`;
                            }
                            const rows = `
                            <tr>
                                <td class='d-none'>${element.idpago}</td>
                                <td class='d-none'>${element.idcliente}</td>
                                <td >${element.cliente}</td>
                                <td>${element.fechapago}</td>
                                <td class='d-none'>${element.producto}</td>
                                <td>${element.deuda_total}</td>
                                <td>${element.pago_total}</td>
                                <td>${element.saldo}</td>      
                                <td>${estadoHTML}</td>
                                <td>
                                    <a href='#' class='mostrar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modalId' data-idcliente='${element.idcliente}'><i class="bi bi-eye"></i></a>
                                </td>
                                                                        

                            </tr>               
                            `;
                            cuerpoTabla.innerHTML += rows;
                        });

                        $("#modalId").on("hidden.bs.modal", function () {
                            cuerpoTabla2.innerHTML = ''; // Vaciar el contenido del cuerpo de la tabla
                        });

                        
                        // Destruir la instancia actual de DataTables
                        if ($.fn.DataTable.isDataTable('#table-report')) {
                            $('#table-report').DataTable().destroy();
                        }

                        $(document).ready(function(){                                    
                        $('#table-report').DataTable({
                            responsive: true ,
                            lengthMenu:[10,5],
                            language: {
                                url: '../js/Spanish.json'
                            },
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excel',
                                    text: '<i class="bi bi-file-excel"></i>',
                                    titleAttr:'Exportar a excel',
                                    title:'REPORTES PAGOS',
                                    className:'btn btn-success',
                                    exportOptions:{ columns: [1,2,3,4,5,6,7] }
                                },                            
                                {
                                    extend: 'print',
                                    text: '<i class="bi bi-printer"></i>',
                                    titleAttr:'imprimir',
                                    title:'REPORTES PAGOS',
                                    className:'btn btn-secondary',
                                    exportOptions:{ columns: [1,2,3,4,5,6,7] }
                                }
                            ],
                        });
                    })
                    }
                    
                })
            }
            

            
            function filtropagocliente(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "filtropagoclientes");              
                parameters.append("idcliente", parseInt(lsCliente.value));

                fetch(`../controllers/reportes.pago.controller.php`, {
                    method: 'POST',
                    body: parameters
                })
                .then(response => response.json())
                .then(data => {
                    if(data.length === ""){                                      
                    Swal.fire({
                        title: "No hay registros",
                        icon: "warning",
                        confirmButtonColor: "#E43D2C",
                     });
                    
                    }else{
                        cuerpoTabla.innerHTML = ``;
                        data.forEach(element => {
                        let estadoHTML = '';

                        if (element.estado === 'Pendiente') {
                            estadoHTML = `<span class="badge bg-danger text-white">${element.estado}</span>`;
                        } else if (element.estado === 'Cancelado') {
                            estadoHTML = `<span class="badge bg-success text-white">${element.estado}</span>`;
                        } else {
                            estadoHTML = `<span class="badge bg-primary">${element.estado}</span>`;
                        }
                        const rows = `
                            <tr>
                                <td class='d-none'>${element.idpago}</td>
                                <td class='d-none'>${element.idcliente}</td>
                                <td>${element.cliente}</td>
                                <td>${element.fechapago}</td>
                                <td class='d-none'>${element.producto}</td>
                                <td>${element.deuda_total}</td>
                                <td>${element.pago_total}</td>
                                <td>${element.saldo}</td>      
                                <td>${estadoHTML}</td> 
                                <td>
                                    <a href='#' class='mostrar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modalId' data-idcliente='${element.idcliente}'><i class="bi bi-eye"></i></a>
                                </td>
                                                                       

                            </tr>
                            `;
                            cuerpoTabla.innerHTML += rows;                        
                        });

                        $("#modalId").on("hidden.bs.modal", function () {
                            cuerpoTabla2.innerHTML = ''; // Vaciar el contenido del cuerpo de la tabla
                        });

                        // Destruir la instancia actual de DataTables
                        if ($.fn.DataTable.isDataTable('#table-report')) {
                            $('#table-report').DataTable().destroy();
                        }

                        $(document).ready(function(){                      
                                       
                        $('#table-report').DataTable({
                            responsive: true ,
                            lengthMenu:[10,5],
                            language: {
                                url: '../js/Spanish.json'
                            },
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excel',
                                    text: '<i class="bi bi-file-excel"></i>',
                                    titleAttr:'Exportar a excel',
                                    title:'REPORTES PAGOS',
                                    className:'btn btn-success',
                                    exportOptions:{ columns: [1,2,3,4,5,6,7] }
                                },                            
                                {
                                    extend: 'print',
                                    text: '<i class="bi bi-printer"></i>',
                                    titleAttr:'imprimir',
                                    title:'REPORTES PAGOS',
                                    className:'btn btn-secondary',
                                    exportOptions:{ columns: [1,2,3,4,5,6,7] }
                                }
                            ],
                        });
                    })
                    }
                    
                })

            }

            function crearpdfdet(){
                window.open(`../reports/detallePago.report.php?`,`_blank`);
            }

            
            function createPDF(){
                const fechaI = document.querySelector("#fechainicio").value;
                const fechaF = document.querySelector("#fechafin").value;
                const cliente = document.querySelector("#cliente").value;

                const parameters = new URLSearchParams();
                parameters.append("fechainicio", document.querySelector("#fechainicio").value);
                parameters.append("fechafin", document.querySelector("#fechafin").value);
                parameters.append("idcliente", parseInt(lsCliente.value));

                parameters.append("fechaI", document.querySelector("#fechainicio").value);
                parameters.append("fechaF", document.querySelector("#fechafin").value);
                
                if(fechaI === '' && fechaF === '' && cliente === ''){
                    Swal.fire({
                        title: "No hay datos para exportar",
                        icon: "warning",
                        confirmButtonColor: "#E43D2C",
                     });

                // }else if(fechaI === '' || fechaF === ''){
                    
            
                }else{
                    window.open(`../reports/filtro.pago.report.php?${parameters}`,`_blank`);
                }
                

            }


            recuperarCliente();
            
            btnfiltro.addEventListener("click", function(){
                const fechaI = document.querySelector("#fechainicio").value;
                const fechaF = document.querySelector("#fechafin").value;
                const idcliente = parseInt(lsCliente.value);
                
                if(!isNaN(idcliente) && idcliente !== 0 && fechaI && fechaF){
                    filtropagofechacliente(idcliente, fechaI, fechaF);
                    

                }else if(fechaI && fechaF){
                    filtropagofecha(fechaI, fechaF);

                }else if(!isNaN(idcliente) && idcliente !==0){
                    filtropagocliente(idcliente)
                }

            });
            
            btnExportar.addEventListener("click",createPDF);
            btnReset.addEventListener("click", function(){
                location.reload();                
            });


            function registrar() {
                const nombre = document.querySelector("#pago").value.trim();            
                // const descripcion = document.querySelector("#descripcion").value.trim();

                let datosEnviar = {
                    'operacion': 'registrar',
                    'idventa': idventa,
                    'banco': $("#banco").val(),
                    'numoperacion': $("#numoperacion").val(),
                    'pago': $("#pago").val(),
                    // 'cantidad': $("#cantidad").val(),
                };
            
                Swal.fire({
                    title: '¿Está seguro de realizar la operación?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#65BB3B',

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
                            url: '../controllers/pagos.controller.php',
                            type: 'GET',
                            data: datosEnviar,
                            success: function (result) {
                                $("#form-pagos")[0].reset();
                                mostrar();
                                $("#modal-registrar").modal('hide');
                            }
                        });

                        }
                
                    }
                });
            }

            $("#guardar").click(registrar);
            btnPDF.addEventListener("click", crearpdfdet);
            
        });
    </script>
</body>
</html>