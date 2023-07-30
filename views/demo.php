<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Inicio</title>
  <link rel="stylesheet" href="../styles/registroventa.css">
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

  <!-- <div class="custom-shape-divider-bottom-1690413515">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
  </div> -->

  <header>
    <div class="navbar">
      <div class="logo"><a href="#">Avicola Vania</a></div>
      <ul class="links">
        <li><a href="ventas.html">Ventas</a></li>
        <li><a href="productos">Productos</a></li>
        <li><a href="clientes">Clientes</a></li>
        <li><a href="reportes">Reportes</a></li>
        <li><a href="contactos">Contactos</a></li>
      </ul>
      <a href="#" class="action_btn">Opción</a>
      <div class="toggle_btn">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>

    <div class="dropdown_menu open">
      <li><a href="ventas.html">Ventas</a></li>
        <li><a href="productos">Productos</a></li>
        <li><a href="clientes">Clientes</a></li>
        <li><a href="reportes">Reportes</a></li>
        <li><a href="contactos">Contactos</a></li>
        <li><a href="#" class="action_btn">Opción</a></li>
    </div>
  </header>

  <main class="mb-5">
    <div class="container mt-3 col-12">
      <div class="card">
        <div class="card-header bg-warning-subtle text-black">
            <h4 class="text-center">REGISTRO DE VENTAS</h4>
        </div>
        <div class="card-body" >
            <form action="" id="form-venta">
              <div class="row">
                <div class="col-lg-4" >
                    <!-- <label for="nombres" class="form-label">Cliente:</label> -->
                    <div class="input-group mb-3 ">
                      <input type="text" class="form-control" placeholder="Cliente" aria-label="Recipient's username" aria-describedby="button-addon2" id="cliente">
                      <button class="btn btn-outline-secondary" type="button" id="button-addon1" data-bs-toggle="modal" data-bs-target="#modalId"><i class='bx bx-search' ></i></button>
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
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="crearCajas()"><i class='bx bx-package' ></i></button>
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
              <h4 class="text-center">DETALLES</h4>
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
            <h5 class="modal-title" id="modalTitleId">REGISTRAR CLIENTE</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" id="registro-cursos">
              <div class="row">
                <div class="mb-3 col-lg-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-search' ></i></span>
                    <input type="text" class="form-control" placeholder="Buscar cliente" maxlength="50" id="nombres">
                  </div>
                </div>

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
                    <input type="text" class="form-control" placeholder="Número DNI" maxlength="50" id="dni">
                  </div>  
                </div>
                <div class="mb-3 col-lg-6">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-phone' ></i></span>
                    <input type="tel" class="form-control" placeholder="900-000-00" maxlength="9" id="telefono">
                  </div>  
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Registrar</button>
            <button type="button" class="btn btn-success">Buscar</button>
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

    if (input1) input1.value = ""; // Verificar si existe y limpiar el input
    if (input2) input2.value = "";
    if (input3) input3.value = "";
    if (input4) input4.value = ""; 
    if (input5) input5.value = "";
    if (input6) input6.value = "";
    if (input7) input7.value = ""; 
    if (input8) input8.value = "";

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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>