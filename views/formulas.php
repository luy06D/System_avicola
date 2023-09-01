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
    <title>Formulas</title>
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

      <!-- estilos de select2   -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                    <li><a class="dropdown-item" href="./addformula.php"><h5><i class="bi bi-file-earmark-plus"></i> Agregar Fórmula</h5></a></li>
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

    <main class="opacity-85 mb-5">
        <div class="container mt-5 col-12">
            <div class="card">
                <div class="card-header bg-light-subtle text-black">
                    <h4 class="text-center">SALIDAS</h4>
                </div>
                <div class="card-body" >
                    <form action="" id="form-formula">
                        <div class="row">

                        <div class="card " style="width: 40rem">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="color: #9C9C9C;">Calcular cantidad de TN/Sacos</h5>
                            <form action="" id="form-calcular">
                                <div class="col-lg-6">

                                    
                                    <div class="mb-4 mt-4">
                                        <div>   
                                            <label for="lista-formula" class="form-label">Seleccione la formula:</label>                                 
                                            <select  id="lista-formula" class="js-example-responsive js-example-placeholder-single js-states form-control" style="width: 100%">
                                            <option value=""></option>
                                            </select>
                                        </div>                               
                                    </div>
                                    <div class="mb-4 mt-4">
                                        <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-minecart-loaded"></i></span>
                                        <input type="number" class="form-control" placeholder="Ingresar toneladas"  id="toneladas">
                                        </div>
                                    </div>
                                    <div class="mb-3 ">
                                        <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-bag-fill"></i></span>
                                        <input type="number" class="form-control" placeholder="Ingresar sacos"  id="sacos">
                                        </div>
                                    </div>
                                    <div class="  mt-4">
                                    <button id="calcular" class="btn btn-warning" type="button">Calcular</button>
                                    <button id="descontar" class="btn btn-success" type="button"><i class="bi bi-arrow-bar-right"></i> Dar salida</button>
                                    </div> 

                                </div>

                            </form>
                            
                        </div>
                        </div>

                        <div class="card " style="width: 40rem">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="color: #9C9C9C;">Generar formula</h5>
                            <form action="" id="form-formula">
                                <div class="col-lg-6">                                                
                                    <div class="mb-4 mt-4">
                                        <div class="input-group  mt-4">
                                            <input type="text" class="form-control"  id="formula"  autocomplete="off" placeholder="Formula">
                                            <button id="registrarFormula" class="btn btn-success" type="button"><i class="bi bi-plus-circle"></i> Agregar</button>
                                        </div> 
                                                                    
                                    </div>                                    
                                    <div class="mb-4 mt-4">
                                        <div>   
                                            <label for="listaF" class="form-label">Seleccione la formula:</label>                                 
                                            <select  id="listaF" class="js-example-placeholder " style="width: 100%">
                                            <option value=""></option>
                                            </select>
                                        </div>                               
                                    </div>                        
                                    <div class="  mt-4">
                                    <div class="col-md-3 mt-4">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button id="btmostrar" class="btn btn-success btn-md " type="button">Mostrar</button>    
                                            <button id="btnDelete" class="btn btn-danger btn-md " type="button"><i class='bi bi-trash'></i> Eliminar</button> 
                                            <button id="" class="btn btn-warning btn-md " type="button" data-bs-toggle="modal" data-bs-target="#modal-addInsumo"><i class="bi bi-plus-circle"></i> Agregar insumo</button>                                       
                                        </div>
                                    </div>  
                                    <div class="col-md-3 mt-4">
                                        <div class="">
                                           
                                        </div>

                                    </div>
                                                                                        
                                    </div> 

                                </div>

                                </form>
                                
                            </div>
                            </div>
                                          

                        </div>
                    </form>
          
                </div>
              
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <table class="table display nowrap" style="width: 100%;"  id="tabla-formula">
                        <thead class="table-success text-center">
                            <tr>
                                <th>Código</th>
                                <th>IDinsumo</th>
                                <th>Insumos</th>
                                <th>KG</th> 
                                <th>Proporción</th>
                                <th>Sacos</th> 
                                <th>Editar</th>                               

                            </tr>
                        </thead>
                        <tbody>
                        <!-- DATOS ASINCRONOS  -->
                        </tbody>
                    </table>
                </div>
            </div>

            

            <label id="total-cantidad">Total Proporción: 0</label>

        </div>
    </main>

   
    <footer>
        <h6 style="text-align: center; position:absolute; bottom:0; width:100%; padding:1em 0; background: #B6B9B9  ; opacity:90%"><img src="../img/3plogo.png" style="width: 40px;" alt=""><a href="https://www.facebook.com/3p.ingenieriaytecnologia"> <img width="25" height="25" src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook-new"/><a href="https://wa.me/962734821"><img width="30" height="30" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/></a></h6>
    </footer>

    
    <!-- Modal Registrar -->
    <div class="modal fade" id="modal-addInsumo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalTitleId">Agregar nuevo insumo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="" id="form-addInsumo">
                        <label for="" class="form-label">Insumo:</label> 
                        <div class=" input-group mb-4">                           
                            <select class="form-select" id="insumo" aria-label="Default select example">
                            <option selected>Seleccione</option>
                            </select>
                        </div>

                        <!-- <label for="" class="form-label">Unidad:</label> 
                        <div class=" input-group mb-4">                           
                            <select class="form-select" id="unidad" aria-label="Default select example">
                            <option selected>Seleccione</option>
                            <option value="KG">KILOS</option>
                            <option value="TN">TONELADA</option>
                            </select>
                        </div> -->
                                     
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-boxes"></i></span>
                          <input type="number" class="form-control" placeholder="Cantidad"  id="cantidad">
                        </div>
        
                    </form>   
                </div>
                <div class="modal-footer">                    
                    <button type="button" id="btnAddInsumo" class="btn btn-outline-warning">Agregar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    
     <!-- Modal Actualizar -->
     <div class="modal fade" id="modal-updateInsumo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalTitleId">Actualizar insumo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="" id="form-updateInsumo">
                        <label for="" class="form-label">Insumo:</label> 
                        <div class=" input-group mb-4">                           
                            <select class="form-select" id="insumoUp" aria-label="Default select example">
                            <option selected>Seleccione</option>
                            </select>
                        </div>

                        <!-- <label for="" class="form-label">Unidad:</label> 
                        <div class=" input-group mb-4">                           
                            <select class="form-select" id="unidadUp" aria-label="Default select example">
                            <option selected>Seleccione</option>
                            <option value="KG">KILOS</option>
                            <option value="TN">TONELADA</option>
                            </select>
                        </div> -->
                                     
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-boxes"></i></span>
                          <input type="number" class="form-control" placeholder="Cantidad"  id="cantidadUp" disabled>
                        </div>
        
                    </form>   
                </div>
                <div class="modal-footer">                    
                    <button type="button" id="btnUpdateInsumo" class="btn btn-outline-warning">Agregar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



    

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AJAX = JavaScript asincrónico-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
    <script src="../js/detalle_insumo.js"></script>
    <!-- datatable-->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- opcional-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

      <!-- select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            $("#lista-formula").select2();
            $(".js-example-placeholder-single").select2({
                placeholder: "Seleccione",
                allowClear: true,                
             });

             $("#listaF").select2();
            $(".js-example-placeholder").select2({
                placeholder: "Seleccione",
                allowClear: true,                
             });


            const lsFormula = document.querySelector("#lista-formula");
            const lsFormulaG = document.querySelector("#listaF");
            const lsInsumo = document.querySelector("#insumo");
            const lsInsumoUp = document.querySelector("#insumoUp");
            const btnFormulaR = document.querySelector("#registrarFormula");
            const cuerpoTabla = document.querySelector("#tabla-formula tbody");
            const btnAddInsumo = document.querySelector("#btnAddInsumo");
            const btmostrar = document.querySelector("#btmostrar");
            const btnUpdateInsumo = document.querySelector("#btnUpdateInsumo");
            const btCalcular = document.querySelector("#calcular");
            

      function mostrarFormula(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "getformula");

                fetch("../controllers/formulas.controller.php", {
                method: 'POST',
                body: parameters
                })
                .then(response => response.json())
                .then(data => {
                lsFormula.innerHTML = "<option value=''>Seleccione formula</option>";
                data.forEach(element => {
                    const optionTag = document.createElement("option");
                    optionTag.value = element.idformula
                    optionTag.text = element.nombreformula;
                    lsFormula.appendChild(optionTag);
                    
                });
                });
      }

      function mostrarFormulaG(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "getformula");

                fetch("../controllers/formulas.controller.php", {
                method: 'POST',
                body: parameters
                })
                .then(response => response.json())
                .then(data => {
                lsFormulaG.innerHTML = "<option value=''>Seleccione formula</option>";
                data.forEach(element => {
                    const optionTag = document.createElement("option");
                    optionTag.value = element.idformula
                    optionTag.text = element.nombreformula;
                    lsFormulaG.appendChild(optionTag);
                    
                });
                });
      }

      
      function mostrarInsumosUp(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "getInsumo");

                fetch("../controllers/formulas.controller.php", {
                method: 'POST',
                body: parameters
                })
                .then(response => response.json())
                .then(data => {
                lsInsumoUp.innerHTML = "<option value=''>Seleccione formula</option>";
                data.forEach(element => {
                    const optionTag = document.createElement("option");
                    optionTag.value = element.idinsumo
                    optionTag.text = element.insumo;
                    lsInsumoUp.appendChild(optionTag);
                    
                });
                });
      }

      function mostrarInsumos(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "getInsumo");

                fetch("../controllers/formulas.controller.php", {
                method: 'POST',
                body: parameters
                })
                .then(response => response.json())
                .then(data => {
                lsInsumo.innerHTML = "<option value=''>Seleccione</option>";
                data.forEach(element => {
                    const optionTag = document.createElement("option");
                    optionTag.value = element.idinsumo
                    optionTag.text = element.insumo;
                    lsInsumo.appendChild(optionTag);
                    
                });
                });
      }

      function formulaRegistrar(){
        const formula = document.querySelector("#formula").value.trim();

        Swal.fire({
            title: "¿Desea registrar una nueva formula?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "Cancelar",
            cancelButtonColor: '#3085d6',
            confirmButtonColor: '#368E5B',

        }).then((result)=>{
            if(result.isConfirmed){
                if(formula === ''){
                    Swal.fire({
                          title: "Por favor, complete el campo formula",
                          icon: "warning",
                          confirmButtonColor: "#E43D2C",
                      });

                }else{
                    const parameter = new URLSearchParams();
                    parameter.append("operacion", "formula_registrar");
                    parameter.append("nombreformula", document.querySelector("#formula").value);


                    fetch("../controllers/formulas.controller.php",{
                        method: 'POST',
                        body: parameter
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.status){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'La formula se registro correctamente',
                                showConfirmButton: false,
                                timer: 1500
                                })
                            document.querySelector("#form-formula").reset();
                            mostrarFormula();
                        }else{
                            Swal.fire({
                          title: "La formula ya fue registrada",
                          icon: "warning",
                          confirmButtonColor: "#E43D2C",
                      });
                            
                        }
                    });

                }

            }
        });

      }


      function filtrarFormula(){
        const parameter = new URLSearchParams();
        parameter.append("operacion", "obtener_formula");
        parameter.append("idformula", document.querySelector("#lista-formula").value);
        parameter.append("cantidadtn", document.querySelector("#toneladas").value);
        parameter.append("cantidadsacos", document.querySelector("#sacos").value);

        fetch(`../controllers/formulas.controller.php`,{
            method: 'POST',
            body: parameter
        })
        .then(response => response.json())
        .then(data => {
            cuerpoTabla.innerHTML = ``;
            data.forEach(element => {                            
                const rows =  `
                <tr>
                    <td>${element.iddetalle_insumo}</td>  
                    <td>${element.idinsumo}</td> 
                    <td>${element.insumo}</td>    
                    <td>${element.cantidad}</td>
                    <td>${element.proporcion}</td>
                    <td>${element.sacos}</td>
                    <td><a href='#' class='detalle_insumo btn btn-outline-warning btn-sm' data-bs-toggle="modal" data-bs-target="#modal-updateInsumo"
                      data-iddetalle_insumo='${element.iddetalle_insumo}'><i class='bi bi-pencil-square'></i></a></td>                                                                                                                                
                </tr>
                `;
                cuerpoTabla.innerHTML += rows;

            });



            // Destruir la instancia DataTable existente
            if ($.fn.DataTable.isDataTable('#tabla-formula')) {
                $('#tabla-formula').DataTable().destroy();
            }

            // Reinicializar la tabla DataTable
            $(document).ready(function(){                                   
                const table = $('#tabla-formula').DataTable({
                    responsive: true ,
                    lengthMenu:[10,5],
                    language: {
                        url: '../js/Spanish.json'
                    },
                    dom: 'Bfrtip'                            
                });


                let totalCantidad = 0;

                $("#tabla-formula tbody tr").each(function() {
                    const cantidad = parseFloat($(this).find("td:nth-child(5)").text());
                    totalCantidad += cantidad;
                });

                // Actualizar el contenido del label
                $("#total-cantidad").text("Total Proporción: " + totalCantidad.toFixed(2)); // Mostrar con 2 decimales

 


                

                // Actualizar la tabla DataTable con los nuevos datos
                const nuevosDatos = data.map(element => [
                    element.iddetalle_insumo,
                    element.idinsumo,
                    element.insumo,
                    element.cantidad,
                    element.proporcion,
                    element.sacos,
                    `<a href='#' class='detalle_insumo btn btn-outline-warning btn-sm' data-bs-toggle="modal" data-bs-target="#modal-updateInsumo"
                      data-iddetalle_insumo='${element.iddetalle_insumo}'><i class='bi bi-pencil-square'></i></a>`
                ]);
                table.clear().rows.add(nuevosDatos).draw();
            });


        })
}


function filtrarFormula2(){
        const parameter = new URLSearchParams();
        parameter.append("operacion", "obtener_formula");
        parameter.append("idformula", document.querySelector("#lista-formula").value);
        parameter.append("cantidadtn", document.querySelector("#toneladas").value);
        parameter.append("cantidadsacos", document.querySelector("#sacos").value);

        fetch(`../controllers/formulas.controller.php`,{
            method: 'POST',
            body: parameter
        })
        .then(response => response.json())
        .then(data => {
            cuerpoTabla.innerHTML = ``;
            data.forEach(element => {  
                console.log("AWRG")                          
                const rows =  `
                <tr>
                    <td>${element.iddetalle_insumo}</td>  
                    <td>${element.idinsumo}</td> 
                    <td>${element.insumo}</td>    
                    <td>${element.cantidad}</td>
                    <td>${element.proporcion}</td>
                    <td>${element.sacos}</td>
                    <td><a href='#' class='detalle_insumo btn btn-outline-warning btn-sm' data-bs-toggle="modal" data-bs-target="#modal-updateInsumo"
                      data-iddetalle_insumo='${element.iddetalle_insumo}'><i class='bi bi-pencil-square'></i></a></td>                                                                                                                                
                </tr>
                `;
                cuerpoTabla.innerHTML += rows;

            });



            // Destruir la instancia DataTable existente
            if ($.fn.DataTable.isDataTable('#tabla-formula')) {
                $('#tabla-formula').DataTable().destroy();
            }

            // Reinicializar la tabla DataTable
            $(document).ready(function(){                                   
                const table2 = $('#tabla-formula').DataTable({
                    responsive: true ,
                    lengthMenu:[10,5],
                    language: {
                        url: '../js/Spanish.json'
                    },
                    dom: 'Bfrtip'                            
                });


                let totalCantidad = 0;

                $("#tabla-formula tbody tr").each(function() {
                    const cantidad = parseFloat($(this).find("td:nth-child(3)").text());
                    totalCantidad += cantidad;
                });

                // Actualizar el contenido del label
                $("#total-cantidad").text("Total GKG/TN: " + totalCantidad.toFixed(2)); // Mostrar con 2 decimales

 

                // Actualizar la tabla DataTable con los nuevos datos
                const nuevosDatos = data.map(element => [
                    element.iddetalle_insumo,
                    element.idinsumo,
                    element.insumo,
                    element.cantidad,
                    element.proporcion,
                    element.sacos,
                    `<a href='#' class='detalle_insumo btn btn-outline-warning btn-sm' data-bs-toggle="modal" data-bs-target="#modal-updateInsumo"
                      data-iddetalle_insumo='${element.iddetalle_insumo}'><i class='bi bi-pencil-square'></i></a>`
                ]);
                table2.clear().rows.add(nuevosDatos).draw();
            });


        })
}




      function detalleF_Registrar(){
        const listaFormula = document.querySelector("#lista-formula").value.trim();
        const insumo = document.querySelector("#insumo").value.trim();
        const cantidad = document.querySelector("#cantidad").value.trim();


        Swal.fire({
            title: "¿Desea agregar un nuevo insumo?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "Cancelar",
            confirmButtonColor: '#65BB3B',

        }).then((result)=>{
            if(result.isConfirmed){
                if(formula === ''){
                    Swal.fire({
                          title: "Por favor, complete el campos",
                          icon: "warning",
                          confirmButtonColor: "#E43D2C",
                      });

                }else{
                    const parameter = new URLSearchParams();
                    parameter.append("operacion", "detalle_registrar");
                    parameter.append("idformula", document.querySelector("#lista-formula").value);
                    parameter.append("idinsumo", document.querySelector("#insumo").value);
                    parameter.append("cantidad", document.querySelector("#cantidad").value);



                    fetch("../controllers/formulas.controller.php",{
                        method: 'POST',
                        body: parameter
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.status){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Insumo agregado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                                })
                            document.querySelector("#form-addInsumo").reset(); 
                            $("#modal-addInsumo").modal('hide');                          
                        }else{
                            Swal.fire({
                          title: "Cantidad no está disponible en stock",
                          icon: "warning",
                          confirmButtonColor: "#E43D2C",
                      });
                            
                        }
                    });

                }

            }
        });

      }







      var formulaR = document.querySelector("#formula");
      formulaR.addEventListener("keydown", function(event){
        if (event.keyCode === 13) {
          event.preventDefault(); 
          formulaRegistrar();
        }
      })



      mostrarFormula();
      mostrarInsumosUp();
      mostrarInsumos();
      mostrarFormulaG();
      btnFormulaR.addEventListener("click", formulaRegistrar);
      btCalcular.addEventListener("click", filtrarFormula);
      btmostrar.addEventListener("click", filtrarFormula2);
      btnAddInsumo.addEventListener("click", detalleF_Registrar);


        })
    </script>
    


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



</body>
</html>

