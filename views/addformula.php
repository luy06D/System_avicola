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
                    <li><a class="dropdown-item" href="./formulas.php"><h5><i class="bi bi-minecart-loaded"></i> Salida</h5></a></li>
                    <li><a class="dropdown-item" href="./addformula.php"><h5><i class="bi bi-file-earmark-plus"></i> Agregar Fórmula</h5></a></li>
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
        <div class="container">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h4 style="text-align: center;">Fórmulas</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-lg-4">
                                <div>   
                                    <label for="selectf" class="form-label">Formulas:</label>                                 
                                    <select  id="selectf" class="js-example-responsive" style="width: 100%;" >
                                    <option value=""></option>
                                    </select>
                                </div>                               
                            </div>
                            <div class="col-lg-8">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button id="btnfiltro" class="btn btn-success btn-md " type="button"><i class="bi bi-funnel-fill"></i></button>
                                    <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modal-form">
                                    <i class="bi bi-plus-circle"></i>  Nueva fórmula
                                    </button>
                                    <button type="button" class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#modal-insumos">
                                    <i class="bi bi-plus-circle"></i> Agregar Insumos
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                        

                        
                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modal-form" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="modalTitleId">Nueva Fórmula</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" id="form-formula">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="nomformula" placeholder="Escriba ...">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-success" id="addform">Agregar</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Registrar -->
                        <div class="modal fade" id="modal-insumos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title" id="modalTitleId">Agregar nuevo insumo</h5>
                                            
                                    </div>
                                    <div class="modal-body">
                                    <form action="" id="form-addInsumo">
                                            <label for="" class="form-label">Fórmulas:</label> 
                                            <div class=" input-group mb-4">                           
                                                <!-- <select class="form-select" id="formu" aria-label="Default select example">
                                                <option selected>Seleccione</option>
                                                </select> -->
                                                <select  id="formu" class="form-select" style="width: 100%;" >
                                                    <option value=""></option>
                                                    </select>
                                            </div>    

                                            <label for="" class="form-label">Insumo:</label> 
                                            <div class=" input-group mb-4">                           
                                                <select class="form-select" id="insumo" aria-label="Default select example">
                                                <option selected>Seleccione</option>
                                                </select>
                                            </div>
 
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
         
                                            <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-boxes"></i></span>
                                            <input type="number" class="form-control" placeholder="Cantidad"  id="cantidadUp">
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
                        

                    </div>
                    
                    
                </div>


                <div class="row mt-3">
                    <div class="col-lg-12">
                        <table class="table display nowrap" style="width: 100%;"  id="tabla-formula">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>Id formula</th>
                                    <th>Id Insumo</th>
                                    <!-- <th>Código</th> -->
                                    <th>Insumos</th>
                                    <th>Cantidad</th> 
                                    
                                    <th>Editar</th>                               

                                </tr>
                            </thead>
                            <tbody>
                            <!-- DATOS ASINCRONOS  -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer style="position: fixed; bottom: 0; width: 100%; background: #B6B9B9; opacity: 0.9;">
        <h6 style="text-align: center; padding: 1em 0;">
            <img src="../img/3plogo.png" style="width: 40px;" alt="">
            <a href="https://www.facebook.com/3p.ingenieriaytecnologia">
                <img width="25" height="25" src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook-new"/>
            </a>
            <a href="https://wa.me/962734821">
                <img width="30" height="30" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/>
            </a>
        </h6>
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

      <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="../js/detalle_insumo.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded",() =>{
            $("#selectf").select2();



            const lsFormula = document.querySelector("#selectf");
            const lsFormula1 = document.querySelector("#formu");
            const lsInsumo = document.querySelector("#insumo");
            const lsInsumoUp = document.querySelector("#insumoUp");
            const btnAddInsumo = document.querySelector("#btnAddInsumo");
            const btnAddFormula = document.querySelector("#addform");
            const btnfiltro = document.querySelector("#btnfiltro");
            const cuerpoTabla = document.querySelector("tbody");

            function recuperarFormula(){
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

            function recuperarFormula1(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "getformula");

                fetch("../controllers/formulas.controller.php", {
                    method: 'POST',
                    body: parameters
                    })
                    .then(response => response.json())
                    .then(data => {
                    lsFormula1.innerHTML = "<option value=''>Seleccione</option>";
                    data.forEach(element => {
                        const optionTag = document.createElement("option");
                        optionTag.value = element.idformula
                        optionTag.text = element.nombreformula;
                        lsFormula1.appendChild(optionTag);
                        
                    });
                });
            }

            function recuperarInsumos(){
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

            function agregarformula(){
              
                // const listaFormula = document.querySelector("#formu").value.trim();

                const formula = document.querySelector("#nomformula").value.trim();
                
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
                            parameter.append("nombreformula", document.querySelector("#nomformula").value);


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
                                    $("#modal-form").modal('hide');
                                    recuperarFormula();
                                    location.reload();
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

            function detalleF_Registrar(){
                
                const listaFormula = document.querySelector("#formu").value.trim();
                const insumo = document.querySelector("#insumo").value.trim();
                const cantidad = document.querySelector("#cantidad").value.trim();

                Swal.fire({
                    title: "¿Desea agregar un nuevo insumo?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Sí",
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#368E5B',

                }).then((result)=>{
                    if(result.isConfirmed){
                        if(listaFormula === '' || insumo === ''){
                            Swal.fire({
                                title: "Por favor, complete el campos",
                                icon: "warning",
                                confirmButtonColor: "#E43D2C",
                            });

                        }else{
                            const parameter = new URLSearchParams();
                            parameter.append("operacion", "detalle_registrar");
                            parameter.append("idformula", document.querySelector("#formu").value);
                            parameter.append("idinsumo", document.querySelector("#insumo").value);
                            parameter.append("cantidad", document.querySelector("#cantidad").value);



                            fetch("../controllers/formulas.controller.php",{
                                method: 'POST',
                                body: parameter
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data)
                                if(data.status){
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Insumo agregado correctamente',
                                        showConfirmButton: false,
                                        timer: 1500
                                        })
                                    document.querySelector("#form-addInsumo").reset(); 
                                    recuperarFormula1();
                                    $("#modal-insumos").modal('hide');                          
                                }else{
                                    Swal.fire({
                                title: "Esté insumo ya fue registrado en esta fórmula",
                                icon: "warning",
                                confirmButtonColor: "#E43D2C",
                            });
                                    
                                }
                            });

                        }

                    }
                });

            }

            function filtroformu(){
                const parameters = new URLSearchParams();
                parameters.append("operacion", "filtro_formu");              
                parameters.append("idformula", parseInt(lsFormula.value));

                fetch(`../controllers/formulas.controller.php`, {
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
                                <td>${element.idformula}</td>
                                <td>${element.idinsumo}</td>
                                <td>${element.insumo}</td>
                                <td>${element.cantidad}</td>
                                <td><a href='#' class='detalle_insumo btn btn-outline-warning btn-sm' data-bs-toggle="modal" data-bs-target="#modal-updateInsumo"
                                data-iddetalle_insumo='${element.iddetalle_insumo}'><i class='bi bi-pencil-square'></i></a></td> 
                                                                                                                   
                            </tr>                            
                            `;
                            cuerpoTabla.innerHTML += rows;
                        });
                
                            if ($.fn.DataTable.isDataTable('#tabla-formula')) {
                                $('#tabla-formula').DataTable().destroy();
                            }

                        $(document).ready(function(){                      
                                       
                        const table = $('#tabla-formula').DataTable({
                            responsive: true ,
                            lengthMenu:[10,5],
                            language: {
                                url: '../js/Spanish.json'
                            },
                            

                        });

                          // Actualizar la tabla DataTable con los nuevos datos
                        const nuevosDatos = data.map(element => [

                            element.iddetalle_insumo,
                            element.idinsumo,
                            element.insumo,
                            element.cantidad,
                            `<a href='#' class='detalle_insumo btn btn-outline-warning btn-sm' data-bs-toggle="modal" data-bs-target="#modal-updateInsumo"
                                data-iddetalle_insumo='${element.iddetalle_insumo}'><i class='bi bi-pencil-square'></i></a>`
                          
                        ]);
                        table.clear().rows.add(nuevosDatos).draw();

                    })
                    }
                    
                })

            }

            btnfiltro.addEventListener("click", function(){
                const idformula = parseInt(lsFormula.value);

                if(!isNaN(idformula) && idformula !==0){
                    filtroformu(idformula)
                }

            });


            recuperarFormula();
            recuperarFormula1();
            recuperarInsumos();
            mostrarInsumosUp();
            btnAddFormula.addEventListener("click", agregarformula);
            btnAddInsumo.addEventListener("click", detalleF_Registrar);

        })
    </script>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



</body>
</html>

