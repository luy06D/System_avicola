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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.css">

    
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
        <div class="container">
            
            <div class="row mt-3 mb-3">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header bg-secondary-subtle  ">
                    <h5 class="text-center">CLIENTES</h5>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 mb-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="addon-wrapping"><i class='bx bxs-user-detail' ></i></span>
                            <input type="text" class="form-control" placeholder="Buscar cliente" aria-label="Recipient's username" aria-describedby="button-addon2" id="cliente">
                        </div>
        
                      </div>
                      <div class="col-md-3 mb-2">
                        <div class="d-grid">
                        <button id="exportar" class="btn btn-success btn-md " type="button">Buscar</button>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="d-grid">
                            <button id="exportar" class="btn btn-primary btn-md " type="button"  data-bs-toggle="modal" data-bs-target="#modalId">Nuevo</button>
                        </div>
                      </div>
                    </div>

                  
                  </div>
                </div>

                
              </div>
              
            </div>

               <!-- Tabla -->
               <div class="row">
                <div class="col-md-12">
                    <table id="table-clientes" class="table table-sm table-striped">
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>Código</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal trigger button -->

    
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark-subtle">
                    <h5 class="text-center modal-title" id="modalTitleId">NUEVO CLIENTE</h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <form action="" id="form-venta">
                        
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
                    <button type="button" class="btn btn-primary">Registrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
    
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- AJAX = JavaScript asincrónico-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    

    
    <script>
      $(document).ready(function(){
          function mostrar(){
              $.ajax({
                  url: '../controllers/',
                  type: 'POST',
                  data: {'operacion' : 'listar'},
                  success: function (result){

                      //referencia al objeto DT
                      var tabla = $("#table-clientes").DataTable();
                      //destruirlo
                      tabla.destroy();

                      //poblar el cuerpo de la tabla
                      $("#table-clientes tbody").html(result);

                      //reconstruimo el cuerpo de la tabla
                      $("#table-clientes").DataTable({
                          responsive: "true",
                          dom: 'Bfrtip',
                          lengthMenu:[5],
                          buttons: [
                              {
                                  extend: 'pdf',
                                  text:'<i class="bx bxs-file-pdf">PDF</i>',
                                  title:'Reportes de Matriculas',
                                  titleAttr: 'exportar pdf',
                                  exportOptions:{ columns: [0,1,2,4,5,6,7] }  
                              }
                              
                          ],
                          language: {
                              url: 'js/Spanish.json'
                          }
                      }); 
                  }
              });
          }
          
          mostrar();


      })
  </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>