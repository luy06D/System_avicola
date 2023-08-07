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
            <div class="row mt-3">
              <!-- formulario -->
              <div class="col-md-4">
                <form action="" autocomplete="off" id="form-">
                  <div class="card">
                    <div class="card-header bg-dark-subtle">
                      <h6 class="text-center ">REGISTRO DE PRODUCTO</h6>
                    </div>
                    <div class="card-body">

                        <!-- <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class='bx bx-category' ></i></span>
                            <select class="form-select" aria-label="Default select example">
                                <option value="">Categotoria</option>
                                <option value="1">Alimentos</option>
                                <option value="2">Avicola</option>
                                <option value="3">otros</option>
                            </select>
                        </div> -->

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class='bx bx-cart-add' ></i></span>
                            <input type="text" class="form-control" placeholder="Nombre producto" maxlength="50" id="producto">
                        </div>


                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class='bx bx-edit' ></i></span>
                            <input type="text" class="form-control" placeholder="Descripción" maxlength="50" id="descripcion">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class='bx bxs-data' ></i></span>
                            <input type="number" class="form-control" placeholder="Cantidad"  id="cantidad" min="1" max="500">
                        </div>
        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class='bx bxs-dollar-circle' ></i></span>
                            <input type="number" class="form-control" placeholder="Precio" id="precio" min="1" step="0.01">
                        </div>
            
                    </div>
        
                    <div class="card-footer text-muted">
                      <div class="d-grid gap-2">
                        <button class="btn btn-sm btn-primary" id="guardar" type="button" >Registrar</button>
                        <button class="btn btn-sm btn-secondary" id="reiniciar" type="reset" >Limpiar</button>
                      </div>
                    </div> <!-- fin del footer  -->
                  </div> <!--Fin del card-->
                </form> <!--Fin del formulario-->
              </div> <!--Fin col-md-4-->
              
        
                <!-- Aqui se construye la tabla -->
                <div class="col-md-8">
                  <table class="table table-sm table-striped" id="tabla-">
                 
                    <thead class="text-center table-secondary">
                      <tr>
                        <th>Código</th>
                        <!-- <th>Categoría</th> -->
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Operación</th>
                      </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                            <th class="text-center" scope="row">1</th>
                            <!-- <td class="text-center">Avicola</td> -->
                            <td class="text-center">huevos</td>
                            <td class="text-center">1°calidad</td>
                            <td class="text-center">325</td>
                            <th class="text-center">8.30</th>
                            <td class="text-center">
                                <a href='#' class='eliminar btn btn-danger btn-sm' >Eliminar</a> 
                                <a href='#' class='editar btn btn-warning btn-sm' >Editar</a>
                            </td>                
                            
                        </tr> 

                    </tbody>
                  </table>
                </div>
            </div>
          </div> <!--fin conteiner -->
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>