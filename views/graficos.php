
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
    <title>Graficos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="../img/remove.ico">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Icons Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- estilos de select2   -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../styles/venta.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
</head>
<body>

<style>
    body{
      font-family: 'Poppins', sans-serif;
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
                <li class="nav-item mt-2">
                <a class="nav-link" aria-current="page" href="ventas.php"><h4><i class="bi bi-cart4"></i> Ventas</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" aria-current="page" href="pagos.php"><h4><i class="bi bi-cash-coin"></i> Pagos</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="productos.php"><h4><i class="bi bi-boxes"></i> Productos</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="usuarios.php"><h4><i class="bi bi-person-gear"></i> Usuarios</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="clientes.php"><h4><i class="bi bi-people"></i> Clientes </h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="./reportes.php"><h4><i class="bi bi-filetype-pdf"></i> Reportes Ventas</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" aria-current="page" href="reportes.pago.php"><h4><i class="bi bi-graph-up-arrow"></i> Reportes Pagos</h4></a>
                </li>
                <li class="nav-item mt-2">
                <a class="nav-link" href="./graficos.php"><h4><i class="bi bi-bar-chart"></i> Gráficos</h4></a>
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

  <div class="container mt-5">
    <div class="col-12">
      <div class="row">

        <div class="col-md-10 col-lg-6 mt-3 mb-3">
          <div class="card">
            <div class="card-header bg-warning text-center text-black"> Cantidad de Ventas en cada dia</div>
            <div class="card-body">
              <canvas id="grafico"></canvas>
              <ul id="lista-leyenda"></ul> 
            </div>
          </div>
        </div>

        <div class="col-md-10 col-lg-6 mt-3 mb-3">
          <div class="card">
            <div class="card-header  bg-success text-center text-white" >Huevos vendidos en un mes</div>
            <div class="card-body">
              <canvas id="grafico2"></canvas>
              <ul id="lista-leyenda2">  </ul>   
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <br>
    <footer>
        <h6 style="text-align: center; position:absolute; bottom:0; width:100%; padding:1em 0; background: #B6B9B9  ; opacity:90%"><img src="../img/3plogo.png" style="width: 40px;" alt=""><a href="https://www.facebook.com/3p.ingenieriaytecnologia"> <img width="25" height="25" src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook-new"/><a href="https://wa.me/962734821"><img width="30" height="30" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/></a></h6>
    </footer>


  <!-- Incluye moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Incluye Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>

    document.addEventListener("DOMContentLoaded", () =>{
      
      const btActualizar = document.querySelector("#actualizar");
      const lienzo = document.getElementById("grafico");
      const leyenda = document.querySelector("#lista-leyenda");

      const graficoBarras = new Chart(lienzo, {
        type: "bar",
        data: {
          labels: [],
          datasets:[
            {
              backgroundColor: ['#3498DB','#E74C3C','#F1C40F','#2ECC71','#8E44AD','#5DADE2','#48C9B0'],
              label: 'Kg de Huevos vendidos en los ultimos 7 dias',
              data:[]
             
              
            }
          ]
        }
      });
      function renderGraphic(coleccion = []){
        let etiquetas = [];
        let datos = [];
        leyenda.innerHTML = ``;

        coleccion.forEach(element =>{
          etiquetas.push(element.Dia);
            datos.push(element.Kilos_Vendidos);

            const  tagLI = document.createElement('li');
            tagLI.innerHTML = `${element.Dia}: <strong>${element.Kilos_Vendidos}</strong`;
            leyenda.appendChild(tagLI);
          });
        graficoBarras.data.labels = etiquetas;
        graficoBarras.data.datasets[0].data = datos;
        graficoBarras.update();
      }

      function loadData(){
        const parametros = new URLSearchParams();
        parametros.append('operacion', 'resumeVentas');

        fetch(`../controllers/ventas.controller.php`,{
          method: 'POST',
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos => {
          renderGraphic(datos);
        });
      }

      

      // Segundo Grafico





const lienzo2 = document.getElementById("grafico2");
const leyenda2 = document.querySelector("#lista-leyenda2");

const graficoBarras2 = new Chart(lienzo2, {
  type: "bar",
  data: {
    labels: [],
    datasets:[
      {
        backgroundColor: ['#3498DB','#E74C3C','#F1C40F','#2ECC71','#8E44AD','#5DADE2','#48C9B0'],
        label: 'Total de Huevos vendidos por meses',
        data:[],
       
      
        
      }
    ]
  }
});
function renderGraphic2(coleccion = []){
  let etiquetas = [];
  let datos = [];
  leyenda2.innerHTML = ``;

  coleccion.forEach(element =>{
    etiquetas.push(element.MONTH);
              datos.push(element.Kilos_Vendidos2);

              const  tag = document.createElement('li');
              tag.innerHTML = `${element.MONTH}: <strong>${element.Ventas}`;
              leyenda2.appendChild(tag);
  });
  graficoBarras2.data.labels = etiquetas;
  graficoBarras2.data.datasets[0].data = datos;

  graficoBarras2.update();
}

function loadData2(){
  const parametros = new URLSearchParams();
  parametros.append('operacion', 'grafico2');

  fetch(`../controllers/ventas.controller.php`,{
    method: 'POST',
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datos => {
    renderGraphic2(datos);
  });
}



 loadData();
 loadData2();

    });
  </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>