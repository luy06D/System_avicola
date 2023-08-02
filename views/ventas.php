<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
   <br><br>
  <main class="opacity-85 mb-5">
    <div class="container mt-5 col-12">
      <div class="card">
        <div class="card-header bg-warning-subtle text-black">
            <h4 class="text-center">REGISTRO DE VENTAS</h4>
        </div>
        <div class="card-body" >
            <form action="" id="form-venta">
              <div class="row">
                <div class="col-lg-4" >
                  <!-- <label for="nombres" class="form-label">Cliente:</label> -->
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="addon-wrapping"><i class='bx bxs-user-detail' ></i></span>
                    <input type="text" class="form-control" placeholder="Buscar cliente" aria-label="Recipient's username" aria-describedby="button-addon2" id="cliente">
                    <button class="btn btn-outline-success" type="button" id="button-addon1" data-bs-toggle="modal" data-bs-target="#modalId"><i class='bx bx-search' ></i></button>
                  </div>
                </div>
              </div>
              <div class="row">

                <div class="mb-3 col-lg-4">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-user' ></i></span>
                    <input type="text" class="form-control" placeholder="Nombres" maxlength="50" id="nombres">
                  </div>
                </div>

                <div class="mb-3 col-lg-4">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-user' ></i></span>
                    <input type="text" class="form-control" placeholder="Apellidos" maxlength="50" id="apellidos">
                  </div>
                </div>

                <div class="mb-3 col-lg-4">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-id-card'></i></span>
                    <input type="text" class="form-control" placeholder="Número DNI" maxlength="8" id="dni">
                  </div>  
                </div>
                <div class="mb-3 col-lg-4">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-phone' ></i></span>
                    <input type="tel" class="form-control" placeholder="900-000-00" maxlength="9" id="telefono">
                  </div>  
                </div>
                
                <div class="col-lg-4">
                    <!-- <label for="fecha" class="form-label">Fecha:</label> -->
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1"><i class='bx bxs-calendar' ></i></span>
                        <input type="date" class="form-control" aria-label="Username" id="fecha">
                    </div>
                </div>
                <div class="col-lg-4">
                  <!-- <label for="cantidad" class="form-label">N° Paquetes:</label> -->
                    <div class="input-group mb-3">
                      <input type="number" placeholder="Digité cantidad paquetes" class="form-control" id="cantidad" min="1" max="500">
                      <button class="btn btn-outline-warning" type="button" id="button-addon2" onclick="crearCajas()"><i class='bx bx-package' ></i></button>
                    </div>
                </div>   
              </div>
            </form>

            <form action="" id="form-paquete">
              <div class="mb-3 colg-6" id="contenedorCajas" >

              </div>
            </form>

            <form action="" id="form-detalle">

              
              <hr>
              <div class="row">
                <div class="col-lg-2" >
                  <label for="totalValores" class="form-label">Total kg:</label>
                  <input type="number" class="form-control" id="totalValores" disabled >
                </div>
                <div class="col-lg-2">
                  <label for="factor" class="form-label">Precio:</label>
                  <input type="number" class="form-control" id="factor" step="0.001" oninput="actualizarTotal()" min="1" max="10">
                </div>
                <div class="col-lg-2">
                  <label for="resultadoMultiplicacion" class="form-label">Monto:</label>
                  <input type="text" class="form-control" id="resultadoMultiplicacion" disabled>
                </div>
                <div class="col-lg-2">
                  <label for="flete" class="form-label">Flete:</label>
                  <input type="number" class="form-control" id="flete" step="0.01" oninput="actualizarTotal()" min="1" max="10" >
                </div>
                <div class="col-lg-4">
                  <label for="resultadoResta" class="form-label">Total a pagar:</label>
                  <input type="text" class="form-control" id="resultadoResta" disabled>
                </div>
              </div>
            </form>
        </div>
        <div class="card-footer text-muted">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- <button class="btn btn-primary " type="button" onclick="crearCajas()">Crear paquetes</button> -->
                <button type="button" class="btn btn-primary">Guardar</button>
                <button class="btn btn-secondary bg-danger"  onclick="limpiarCajas()" >Limpiar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
      </div>
    </div>

  </main>

  <footer>
    <h6 style="text-align: center;">Copyright - 2023</h6>
  </footer>

  <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">CLIENTES</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" id="registro-cursos">
              <div class="row">
                <div class="mb-3 col-lg-10">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bxs-user-detail' ></i></span>
                    <input type="text" class="form-control" placeholder="Buscar cliente" maxlength="50" id="nombres">
                  </div>
                </div>
                
                <div class="mb-3 col-lg-2">
                  <div class="input-group mb-3">
                    <button type="button" class="btn btn-success"><i class='bx bx-search'></i></button>
                  </div>
                </div>

                <div class="table-responsive">
                  <form action="">
                      <table class="table table-striped" id="tabla-clientes">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Nombres</th>
                                  <th>Apellidos</th>
                                  <th>DNI</th>
                                  <th>Teléfono</th>
                                  <th>Operación</th>
                              </tr>
                          </thead>
                          <tbody class="table-group-divider">
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td><a href='#' class='eliminar btn btn-warning btn-sm'>Seleccionar</a></td>
                          </tr>
                          </tbody>
                      </table>
                  </form>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary">Registrar</button> -->
            
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
          </div>
        </div>
      </div>
    </div>

  <!-- Optional: Place to the bottom of scripts -->
  <script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
  
  </script>
  <script>
    const toggleBtn = document.querySelector('.toggle_btn')
    const toggleBtnIcon = document.querySelector('.toggle_btn i')
    const dropDownMenu = document.querySelector('.dropdown_menu')

    toggleBtn.onclick = function(){
      dropDownMenu.classList.toggle('open')
      const isOpen = dropDownMenu.classList.contains('open')

      toggleBtnIcon.classList = isOpen
      ? 'fa-solid fa-xmark'
      : 'fa-solid fa-bars'
    }
  </script>

<script>
  function crearCajas() {
      var cantidad = parseInt(document.getElementById("cantidad").value);

      if (isNaN(cantidad) || cantidad < 1 || cantidad > 500) {
          alert("Ingrese un número válido entre 1 y 500.");
          return;
      }

      var contenedorCajas = document.getElementById("contenedorCajas");
      contenedorCajas.innerHTML = ""; // Limpiamos el contenido previo

      for (var i = 0; i < cantidad; i++) {
          var nuevaCaja = document.createElement("input");
          nuevaCaja.type = "number";
          nuevaCaja.id = "caja";
          nuevaCaja.className = "col-2";
          nuevaCaja.placeholder = "Paquete " + (i + 1);
          nuevaCaja.addEventListener("input", actualizarTotal);
          contenedorCajas.appendChild(nuevaCaja);
      }

      actualizarTotal();
  }

  function limpiarCajas() {
    const cajasContainer = document.getElementById("contenedorCajas");
    cajasContainer.innerHTML = ""; // Elimina el contenido del contenedor
    
    const input1 = document.getElementById("cliente");
    const input2 = document.getElementById("fecha");
    const input3 = document.getElementById("cantidad");
    const input4 = document.getElementById("totalValores");
    const input5 = document.getElementById("factor");
    const input6 = document.getElementById("resultadoMultiplicacion");
    const input7 = document.getElementById("flete");
    const input8 = document.getElementById("resultadoResta");
    const input9 = document.getElementById("nombres");
    const input10 = document.getElementById("apellidos");
    const input11 = document.getElementById("dni");
    const input12 = document.getElementById("telefono");

    if (input1) input1.value = ""; // Verificar si existe y limpiar el input
    if (input2) input2.value = "";
    if (input3) input3.value = "";
    if (input4) input4.value = ""; 
    if (input5) input5.value = "";
    if (input6) input6.value = "";
    if (input7) input7.value = ""; 
    if (input8) input8.value = "";
    if (input9) input9.value = "";
    if (input10) input10.value = "";
    if (input11) input11.value = "";
    if (input12) input12.value = "";

  }


  function actualizarTotal() {
      var cajas = document.getElementById("contenedorCajas").getElementsByTagName("input");
      var sumaValoresCajas = 0;

      for (var i = 0; i < cajas.length; i++) {
          sumaValoresCajas += parseFloat(cajas[i].value) || 0; // Si el valor no es un número, se sumará 0.
      }

      var factor = parseFloat(document.getElementById("factor").value) || 0;
      var flete = parseFloat(document.getElementById("flete").value) || 0;

      var totalMultiplicacion = sumaValoresCajas * factor;
      var totalConFlete = totalMultiplicacion - (flete * sumaValoresCajas);
      totalConFlete = totalConFlete.toFixed(2);

      document.getElementById("totalValores").value = sumaValoresCajas.toFixed(2);
      document.getElementById("resultadoMultiplicacion").value = totalMultiplicacion.toFixed(2);
      document.getElementById("resultadoResta").value = totalConFlete;
  }
</script>

<script>
  // Función para obtener la fecha actual en formato "YYYY-MM-DD"
  function obtenerFechaActual() {
    const fechaActual = new Date();
    const year = fechaActual.getFullYear();
    const month = String(fechaActual.getMonth() + 1).padStart(2, '0');
    const day = String(fechaActual.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  }

  // Captura la fecha actual y asigna el valor al input
  const fechaInput = document.getElementById('fecha');
  fechaInput.value = obtenerFechaActual();
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>