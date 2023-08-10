<?php
session_start();

if(!isset($_SESSION['segurity']) || $_SESSION['segurity']['login'] == false){
  header('Location:../index.php');
}

$idusuario = $_SESSION['segurity']['idusuario'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Inicio</title>
  <link rel="icon" href="../img/remove.ico">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- estilos de select2   -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../styles/venta.css">
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
                <a class="nav-link" href="./reportes.php">Reportes</a>
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
   <br><br>
  <main class="opacity-85 mb-5">
    <div class="container mt-5 col-12">
      <div class="card">
        <div class="card-header bg-warning text-white" >
            <h4 class="text-center">REGISTRO DE VENTAS</h4>
        </div>
        <div class="card-body" >
            <form action="" id="form-venta">             
              <div class="row">

              <div class="col-lg-4">
                  <div class="mb-3">   
                    <label for="cliente" class="form-label">Cliente:</label>                                 
                    <select  id="cliente" class="js-example-responsive" style="width: 100%;" >
                      <option value=""></option>
                    </select>
                  </div>
                </div>

              <div class="col-lg-4">
              <div class="input-group mt-4">
                <select class="form-select" id="producto">
                  <option selected>Seleccione</option>                 
                </select>                
                <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add' ></i></label>
              </div>

              </div>

                <div class="col-lg-4">
                  <!-- <label for="cantidad" class="form-label">N° Paquetes:</label> -->
                    <div class="input-group mt-4">
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
                <button type="button" class="btn btn" style="background-color: #F7DC6F;" id="btnRegistrar">Registrar</button>
                <button class="btn btn-secondary "  onclick="limpiarCajas()" >Limpiar</button>                
            </div>
        </div>
      </div>
    </div>

  </main>

  <footer>
    <h6 style="text-align: center;">Copyright - 2023</h6>
  </footer>

        <!-- CDN sweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>              
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="../js/operacion.js"></script>
        
      <!-- select2 -->
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

  document.addEventListener("DOMContentLoaded", () => {

    //Activa el select2 en clientes
    $("#cliente").select2();
    
    const lsProducto = document.querySelector("#producto");
    const lsCliente = document.querySelector("#cliente");
    const btnRegistrar = document.querySelector("#btnRegistrar");

    function mostrarProductos(){
      const parameters = new URLSearchParams();
      parameters.append("operacion", "recuperarProduct");

      fetch("../controllers/ventas.controller.php", {
        method: 'POST',
        body: parameters
      })
      .then(response => response.json())
      .then(data => {
        lsProducto.innerHTML = "<option value=''>Seleccione</option>";
        data.forEach(element => {
          const optionTag = document.createElement("option");
          optionTag.value = element.idproducto
          optionTag.text = element.nombre;
          lsProducto.appendChild(optionTag);
          
        });
      });
    }

    function mostrarClientes(){
      const parameters = new URLSearchParams();
      parameters.append("operacion", "recuperarClient");

      fetch("../controllers/ventas.controller.php", {
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

    function ventasRegistrar(){

      const producto = document.querySelector("#producto").value.trim();
      const cliente = document.querySelector("#cliente").value.trim();
      const cantidad = document.querySelector("#cantidad").value.trim();
      const precio = document.querySelector("#factor").value.trim();
      const flete = document.querySelector("#flete").value.trim();
      let idUsuario = <?php echo json_encode($idusuario) ?>;

      Swal.fire({
          title: "¿Está seguro de registrar?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Sí",
          cancelButtonText: "Cancelar",
          confirmButtonColor: '#65BB3B',

      }).then((result)=>{
        if(result.isConfirmed){
          if(cliente === '' || producto === '' ||
            cantidad === '' || precio === '' || flete === ''){

                  Swal.fire({
                        title: "Por favor, complete los campos",
                        icon: "warning",
                        confirmButtonColor: "#E43D2C",
                     });
            }else{


              const parameters = new URLSearchParams();
              parameters.append("operacion", "ventasRegistrar");
              parameters.append("idproducto", document.querySelector("#producto").value);
              parameters.append("cantidad", document.querySelector("#cantidad").value);
              parameters.append("idusuario", idUsuario);
              parameters.append("idcliente", document.querySelector("#cliente").value);
              parameters.append("kilos", document.querySelector("#totalValores").value);
              parameters.append("precio", document.querySelector("#factor").value);
              parameters.append("flete", document.querySelector("#flete").value);

              fetch("../controllers/ventas.controller.php",{
                method: 'POST',
                body: parameters
              })
              .then(response => response.json())
              .then(data => {
                if(data.status){
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'La venta se registro correctamente',
                    showConfirmButton: false,
                    timer: 1500
                    })
                    document.querySelector("#form-venta").reset();
                    document.querySelector("#form-detalle").reset();
                    document.querySelector("#form-paquete").reset();
                    $("#cliente").val(null).trigger('change');
                  
                }else{
                  Swal.fire("Error", data.message, "error");  

                }

              });

            }
          
       
        }


      });


    }

    mostrarProductos();
    mostrarClientes();

    btnRegistrar.addEventListener("click", ventasRegistrar);



  });


  
</script>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>