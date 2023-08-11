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
    <title>Inicio</title>
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
        overflow: hidden;
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
                <li class="nav-item mt-2">
                <a class="nav-link" aria-current="page" href="ventas.php"><h4><i class="bi bi-cart4"></i> Ventas</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="productos.php"><h4><i class="bi bi-boxes"></i> Productos</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="clientes.php"><h4><i class="bi bi-people"></i> Clientes </h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="./reportes.php"><h4><i class="bi bi-filetype-pdf"></i> Reportes</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="./graficos.php"><h4><i class="bi bi-bar-chart"></i> Gráficos</h4></a>
                </li>
                <li class="nav-item mt-5">
                <a class="nav-link" href="../controllers/usuario.controller.php?operation=destroy"><h4><i class="bi bi-box-arrow-left"></i> Cerrar sesión</h4></a>
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
                    <h4 class="text-center">FILTRADO</h4>
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
                                </div>
                            </div>                     
                               
                            <!-- <div class="mb-3 col-lg-2">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-primary"><i class='bx bx-filter-alt' ></i></button>
                                    <button class="btn btn-secondary bg-danger" ><i class='bx bxs-file-pdf' ></i></button>
                                </div>
                            </div> -->
                            
                        </div>
                    </form>
          
                </div>
              
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <table class="table display nowrap" style="width: 100%;"  id="table-report">
                        <thead class="table-success text-center">
                            <tr>
                                <th>Cliente</th>
                                <th>Kilos</th>
                                <th>Precio</th>
                                <th>Flete</th>
                                <th>Fecha Venta</th>
                                <th>Total Venta</th>
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




    <script>
        document.addEventListener("DOMContentLoaded", () =>{

              //Activa el select2 en clientes
             $("#cliente").select2();

            const cuerpoTabla = document.querySelector("#table-report tbody");
            const btnfiltro = document.querySelector("#btnfiltro");
            const btnExportar = document.querySelector("#exportar");
            const lsCliente = document.querySelector("#cliente");

            
            function recuperarCliente(){
            const parameters = new URLSearchParams();
            parameters.append("operacion", "recuperarCliente");

            fetch("../controllers/reportes.controller.php", {
                method: 'POST',
                body: parameters
            })
            .then(response => response.json())
            .then(data => {
                lsCliente.innerHTML = "<option value=''>Seleccione</option>";
                data.forEach(element => {
                const optionTag = document.createElement("option");
                optionTag.value = element.idpersona
                optionTag.text = element.clientes;
                lsCliente.appendChild(optionTag);
                
                });
            });
            }



            function filtro2Ventas(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "filtra2Ventas");
                parameters.append("fechainicio", document.querySelector("#fechainicio").value);
                parameters.append("fechafin", document.querySelector("#fechafin").value);

                fetch(`../controllers/reportes.controller.php`, {
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
                        const rows = `
                        <tr>
                            <td>${element.clientes}</td>
                            <td>${element.kilos}</td>
                            <td>${element.precio}</td>
                            <td>${element.flete}</td>
                            <td>${element.fechaventa}</td>
                            <td>${element.totalPago}</td>                        
                        </tr>
                        `;
                        cuerpoTabla.innerHTML += rows;                        
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
                                    title:'Productos',
                                    className:'btn btn-success',
                                    exportOptions:{ columns: [0,1,2,3] }
                                },                            
                                {
                                    extend: 'print',
                                    text: '<i class="bi bi-printer"></i>',
                                    titleAttr:'imprimir',
                                    title:'Productos',
                                    className:'btn btn-secondary',
                                    exportOptions:{ columns: [0,1,2,3] }
                                }
                            ],
                            
                        });
                    })

                    }           
           
                })                            
            }

            function filtro3Ventas(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "filtra3Ventas");
                parameters.append("fechainicio", document.querySelector("#fechainicio").value);
                parameters.append("fechafin", document.querySelector("#fechafin").value);
                parameters.append("idcliente", parseInt(lsCliente.value));

                fetch(`../controllers/reportes.controller.php`, {
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
                        data.forEach(element =>{
                            const rows = `
                            <tr>
                                <td>${element.clientes}</td>
                                <td>${element.kilos}</td>
                                <td>${element.precio}</td>
                                <td>${element.flete}</td>
                                <td>${element.fechaventa}</td>
                                <td>${element.totalPago}</td>                        
                            </tr>                            
                            `;
                            cuerpoTabla.innerHTML += rows;
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
                                    title:'Productos',
                                    className:'btn btn-success',
                                    exportOptions:{ columns: [0,1,2,3] }
                                },                            
                                {
                                    extend: 'print',
                                    text: '<i class="bi bi-printer"></i>',
                                    titleAttr:'imprimir',
                                    title:'Productos',
                                    className:'btn btn-secondary',
                                    exportOptions:{ columns: [0,1,2,3] }
                                }
                            ],
                        });
                    })
                    }
                    
                })
            }

            
            function filtro1Ventas(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "filtra1Ventas");              
                parameters.append("idcliente", parseInt(lsCliente.value));

                fetch(`../controllers/reportes.controller.php`, {
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
                        data.forEach(element =>{
                            const rows = `
                            <tr>
                                <td>${element.clientes}</td>
                                <td>${element.kilos}</td>
                                <td>${element.precio}</td>
                                <td>${element.flete}</td>
                                <td>${element.fechaventa}</td>
                                <td>${element.totalPago}</td>                        
                            </tr>                            
                            `;
                            cuerpoTabla.innerHTML += rows;
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
                                    title:'Productos',
                                    className:'btn btn-success',
                                    exportOptions:{ columns: [0,1,2,3] }
                                },                            
                                {
                                    extend: 'print',
                                    text: '<i class="bi bi-printer"></i>',
                                    titleAttr:'imprimir',
                                    title:'Productos',
                                    className:'btn btn-secondary',
                                    exportOptions:{ columns: [0,1,2,3] }
                                }
                            ],
                        });
                    })
                    }
                    
                })
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
                    window.open(`../reports/filtro.report.php?${parameters}`,`_blank`);
                }
                

            }



            recuperarCliente();
            
            btnfiltro.addEventListener("click", function(){
                const fechaI = document.querySelector("#fechainicio").value;
                const fechaF = document.querySelector("#fechafin").value;
                const idcliente = parseInt(lsCliente.value);

                if(!isNaN(idcliente) && idcliente !== 0 && fechaI && fechaF){
                    filtro3Ventas(idcliente, fechaI, fechaF);
                    

                }else if(fechaI && fechaF){
                    filtro2Ventas(fechaI, fechaF);

                }else if(!isNaN(idcliente) && idcliente !==0){
                    filtro1Ventas(idcliente)
                }

            });
            btnExportar.addEventListener("click",createPDF);
        });
    </script>
</body>
</html>