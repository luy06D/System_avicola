<?php
session_start();

//Si el usuario ya tiene una sesión activa ... entonces NO DEBE ESTAR AQUI 
if(isset($_SESSION['segurity']) && $_SESSION['segurity']['login']){
   header('Location:views/ventas.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
   <link rel="stylesheet" type="text/css" href="./styles/login.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <!-- <link rel="stylesheet" href="css/all.min.css"> -->
   <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> --> 
   <title>Inicio de sesión</title>
   <link rel="icon" href="./img/remove.ico">
</head>

<body>

<div class="custom-shape-divider-bottom-1690413515">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div>
  
   <div class="container">
      <div class="img">
         <img src="./img/vania_logo.jpeg">
      </div>
      <div class="login-content">
         <form method="post" action="">
            <img src="./img/usuario (3).png">
            <h2 class="title">BIENVENIDO</h2>
            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <h5>Usuario</h5>
                  <input id="usuario" type="text" class="input" name="usuario">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Contraseña</h5>
                  <input type="password" id="password" class="input" name="password">
               </div>
            </div>
            <div class="view">
               <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>

            <div class="text-center register">            
               <a class="font-italic isai5" href="./views/newusuario.php">Registrarse</a>
            </div>
            <button id="btniniciar" class="btn" type="button">INICIAR SESION</button>
         </form>
      </div>
   </div>
   
   <script src="./js/fontawesome.js"></script>
   <script src="./js/verpassword.js"></script>
   <script src="./js/tagfloat.js"></script>
   <!-- CDN jquery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   <!-- CDN sweetAlert2 -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script>
      $(document).ready(function(){

         function login(){
            const data = {
               "operation"       : "log_in",
               "nombreusuario"   : $("#usuario").val(),
               "claveacceso"     : $("#password").val(),
            };

            $.ajax({
               url:'./controllers/usuario.controller.php',
               type: 'GET',
               data: data,
               dataType: 'JSON',
               success: function(result){
                  if(result.login){
                     Swal.fire({
                        title: 'Inicio correctamente',
                        text: 'Bienvenido: ' + `${result.apellidos} ${result.nombres}`,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200

                     }).then((result) => {
                        if(result){
                           window.location.href = `./views/ventas.php`;
                        }
                     })
                  }
                  else if(result.mensaje == "Contraseña"){
                     Swal.fire({
                        title: 'Contraseña incorrecta',
                        icon: 'error',
                        confirmButtonText: `OK`,
                        confirmButtonColor: '#E43D2C'

                     })
                  }else{
                     Swal.fire({
                        title: 'El usuario ingresado es incorrecto',
                        icon: 'error',
                        confirmButtonText: `OK`,
                        confirmButtonColor: '#E43D2C'
                      })
                  }                  
               }
            });


         }


         $("#btniniciar").click(login);

         $("#password").keypress(function (evt){
            if(evt.keyCode == 13){
               login();
            }
         })

      });
   </script>

</body>

</html>