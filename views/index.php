<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="stylesheet" href="../styles/registroventa.css">

</head>
<body>

  <header>
    <div class="navbar">
      <div class="logo"> <img src="../img/remove.png" alt=""><a href="#"></a></div>

      <?php
        require_once './menuOpciones.php';
      ?>
      <!-- <ul class="links">
        <li><a href="ventas.html">Ventas</a></li>
        <li><a href="productos">Productos</a></li>
        <li><a href="clientes">Clientes</a></li>
        <li><a href="reportes">Reportes</a></li>
        <li><a href="contactos">Contactos</a></li>
      </ul>
      <a href="#" class="action_btn">Opción</a>
      <div class="toggle_btn">
        <i class="fa-solid fa-bars"></i>
      </div> -->
    </div>

    
  </header>

  <div class="container-fluid" id="content-dinamics">
    <!-- contenidos -->
  </div>

  <footer>
    <h6 style="text-align: center;">Copyright - 2023</h6>
  </footer>

  <script>
        document.addEventListener("DOMContentLoaded", () =>{

            //Crearemos una función que obtenga la URL(Vista)
            function getURL(){
                //1.Obtener la URL
                const url = new URL(window.location.href);
                //console.log(url);
                //2. Obtener el valor enviado por la url
                // busques y obtengan la vista
                const vista = url.searchParams.get("views");
                //console.log(vista);
                // 3. crear un objeto que referencia contenerdor
                const contenerdor = document.querySelector("#content-dinamics");
                //console.log(vista);

                //Cuando el usuario elige una opción diferente ! = !=
                if(vista !=null){
                    fetch(vista)
                        .then(respuesta => respuesta.text())
                        .then(datos =>{
                            contenerdor.innerHTML = datos;

                            //Necesitamos recorrer todas las etiquetas <script> y "reactivarlas"
                            const scriptsTag = contenerdor.getElementsByTagName("script");
                            //console.log(scriptsTag);
                            for(i = 0; i < scriptsTag.length; i++){
                                eval(scriptsTag[i].innerText);
                            }
                        });
                }
            }
            getURL();
        });
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

</html>