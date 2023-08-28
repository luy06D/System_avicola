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
  <title>Ventas</title>
  <link rel="icon" href="../img/remove.ico">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Icons Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- estilos de select2   -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  
</head>
<body>
  <style>
    .cajastyle{
      margin: 4px;
      width: 130px;
    }
    body{
      font-family: 'Poppins', sans-serif;
      /* overflow: hidden; */
      background-image: url(../img/eggs-3281585_1280.jpg);
      position: relative;
      padding-bottom: 3em;
      min-height: 100vh;
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed; 
    }


  </style>

  <header >
    <nav class="navbar navbar-light bg-warning-subtle fixed-top opacity-100">
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
        <div class="card-header text-white" style="background-color: #9ACD32;" >
            <h4 class="text-center">REGISTRO DE VENTAS</h4>
        </div>
        <div class="card-body" >
            <form action="" id="form-venta">             
              <div class="row">

              <div class="col-lg-4">
                  <div class=" input-group mb-3">   
                    <label for="" class="form-label">Cliente:</label>                                 
                    <select  class="js-example-responsive"  id="cliente" style="width: 100%;" >
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
                <button type="button" class="btn btn text-white" style="background-color:#9ACD32;" id="btnRegistrar">Registrar</button>
                <button class="btn btn-secondary "  onclick="limpiarCajas()" >Limpiar</button>                
                <button id="exportar" class="btn btn-danger" type="button"><i class="bi bi-file-earmark-pdf"></i></button>
            </div>
        </div>
      </div>
    </div>

  </main>

  <footer>
    <h6 style="text-align: center; position:absolute; bottom:0; width:100%; padding:1em 0; background: #B6B9B9  ; opacity:90%"><img src="../img/3plogo.png" style="width: 40px;" alt=""><a href="https://www.facebook.com/3p.ingenieriaytecnologia"> <img width="25" height="25" src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook-new"/><a href="https://wa.me/962734821"><img width="30" height="30" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/></a></h6>
  </footer>

  

  <!-- CDN sweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>              
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="../js/operacion.js"></script>
  
  <!-- select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="../js//operacion.js"></script>
  
  <script>

    document.addEventListener("DOMContentLoaded", () => {

      //Activa el select2 en clientes
      $("#cliente").select2();

      
      
      const lsProducto = document.querySelector("#producto");
      const lsCliente = document.querySelector("#cliente");
      const btnRegistrar = document.querySelector("#btnRegistrar");
      const btnPDF = document.querySelector("#exportar");
      const caja = document.querySelector("#caja");
      

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
            optionTag.value = element.idcliente
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
        const valoresCajas = crearCajas();
        


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
                parameters.append("deuda",document.querySelector("#resultadoResta").value);
                parameters.append("paquetes", JSON.stringify(valoresCajas));

                // console.log("idproducto", document.querySelector("#producto").value);
                // console.log("cantidad", document.querySelector("#cantidad").value);
                // console.log("idusuario", idUsuario);
                // console.log("idcliente", document.querySelector("#cliente").value);
                // console.log("kilos", document.querySelector("#totalValores").value);
                // console.log("precio", document.querySelector("#factor").value);
                // console.log("flete", document.querySelector("#flete").value);
                // console.log("deuda", document.querySelector("#resultadoResta").value);
                // console.log("paquetes", JSON.stringify(valoresCajas));

                

                

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
                      
                      limpiarCajas();
                      $("#cliente").val(null).trigger('change');
                    
                  }else{
                    Swal.fire("Error", data.message, "error");  

                  }

                });

              }
            
        
          }


        });


      }


   
  
      var cantidadInput = document.getElementById("cantidad");
      cantidadInput.addEventListener("keydown", function(event) {
        if (event.keyCode === 13) {
          event.preventDefault(); // Prevenir el comportamiento predeterminado del Enter (enviar formulario)
          crearCajas();
        }
      });

      mostrarProductos();
      mostrarClientes();

      btnRegistrar.addEventListener("click", ventasRegistrar);

      btnPDF.addEventListener("click", function(){

        window.open(`../reports/venta.report.php?`,`_blank`);
      })
      

    });

  </script>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>