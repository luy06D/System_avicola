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
</head>

<body>

    <header>
        <nav class="navbar navbar-light bg-warning-subtle fixed-top">
            <div class="container-fluid ">
            <a class="navbar-brand" href="#"><img src="../img/remove.png" style="width: 50px;" alt=""></a>
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
                    <a class="nav-link" href="./graficos.php">Graficos</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../controllers/usuario.controller.php?operation=destroy">Cerrar sesión</a>
                    </li>
                </ul>
                
                </div>
            </div>
            </div>
        </nav>
    </header>
    
    <br><br><br><br>

    <main class="opacity-85 mb-5">
        <div class="container mt-5 col-12">
            <div class="card">
                <div class="card-header bg-light-subtle text-black">
                    <h4 class="text-center">FILTRADO</h4>
                </div>
                <div class="card-body" >
                    <form action="" id="form-venta">
                        <div class="row">
                            <div class="mb-3 col-lg-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' ></i></span>
                                    <input type="date" class="form-control"  id="fechainicio">
                                </div>
                            </div>

                            <div class="mb-3 col-lg-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' ></i></span>
                                    <input type="date" class="form-control"  id="fechafin">
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="d-grid">
                                    <button id="btnfiltro" class="btn btn-success btn-md " type="button">Filtrar</button>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="d-grid">
                                    <button id="exportar" class="btn btn-danger btn-md " type="button">Exportar</button>
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
   


    <script>
        document.addEventListener("DOMContentLoaded", () =>{

            const cuerpoTabla = document.querySelector("#table-report tbody");
            const btnfiltro = document.querySelector("#btnfiltro");
            const btnExportar = document.querySelector("#exportar");

            function filtroVentas(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "filtraVentas");
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

                    $(document).ready(function(){
                        $('#table-report').DataTable({
                            responsive: true ,
                            lengthMenu:[10,5],
                            language: {
                                url: '../js/Spanish.json'
                            }
                        });
                    })

                    }           
           
                })                            
            }

            function createPDF(){
                const parameters = new URLSearchParams();
                parameters.append("fechainicio", document.querySelector("#fechainicio").value);
                parameters.append("fechafin", document.querySelector("#fechafin").value);
                parameters.append("fechaI", document.querySelector("#fechainicio").value);
                parameters.append("fechaF", document.querySelector("#fechafin").value);
                            
                window.open(`../reports/filtro.report.php?${parameters}`,`_blank`);

            }



   


            btnfiltro.addEventListener("click", filtroVentas);
            btnExportar.addEventListener("click",createPDF);
        });
    </script>
</body>
</html>