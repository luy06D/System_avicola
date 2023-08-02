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
                    <a class="nav-link" href="#">Cerrar sesión</a>
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
                <div class="card-header bg-dark-subtle text-black">
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
                                    <button id="exportar" class="btn btn-success btn-md " type="button">Filtrar</button>
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

                    <table class="table">
                        <thead class="table-success text-center">
                            <tr>
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Teléfono</th>
                                <th>producto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>953684217</td>
                                <td>huevos</td>
                                <td>10kg</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mark</td>
                                <td>953684217</td>
                                <td>huevos</td>
                                <td>10kg</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Mark</td>
                                <td>953684217</td>
                                <td>huevos</td>
                                <td>10kg</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Mark</td>
                                <td>953684217</td>
                                <td>huevos</td>
                                <td>10kg</td>
                            </tr>
                        </tbody>
                      </table>
                </div>
              
            </div>
        </div>
    </main>

    
   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>