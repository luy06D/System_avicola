<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" type="text/css" href="../styles/newusuario.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <!-- <link rel="stylesheet" href="css/all.min.css"> -->
   <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
   
   <title>REGISTRO</title>
   <link rel="icon" href="../img/remove.ico">
</head>

<body>


   <div class="container">
      <div class="login-content">
         <form method="post" action="" id="form_newusuario">
            <img src="../img/usuario (3).png">
            <h2 class="title">REGISTRO</h2>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <h5>Nombres</h5>
                  <input id="nombre" type="text" class="input" name="nombre" autocomplete="off" maxlength="30">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Apellidos</h5>
                  <input type="text" id="apellido" class="input" name="apellido" maxlength="30">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Dni (Opcional)</h5>
                  <input type="text" id="dni" class="input" name="dni" maxlength="8">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Teléfono (Opcional)</h5>
                  <input type="tel" id="telefono" class="input" name="telefono" maxlength="9">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Usuario</h5>
                  <input type="text" id="usuario" class="input" name="usuario" autocomplete="off" maxlength="30">
               </div>
            </div>   
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Contraseña</h5>
                  <input type="password" id="contraseña" class="input" name="contraseña" maxlength="50">
               </div>
            </div>           
            <button id="btnRegistrar" class="btn" type="button">REGISTRAR</button>
         </form>
      </div>
   </div>
   
   <script src="../js/tagfloat.js"></script>
  
   <!-- CDN jquery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <!-- CDN sweetAlert2 -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


   <script>
      

      $(document).ready(function (){

         function usuariosRegistrar(){

            let nombres = $("#nombre").val();
            let apellidos = $("#apellido").val();
            let usuario = $("#usuario").val();
            let contraseña = $("#contraseña").val();

            let dataR = {
               'operation'    :'UsuariosRegistrar',
               'nombres'      : $("#nombre").val(),
               'apellidos'    : $("#apellido").val(),
               'dni'          : $("#dni").val(),
               'telefono'     : $("#telefono").val(),
               'nombreusuario': $("#usuario").val(),
               'claveacceso'  : $("#contraseña").val(),
            };

            Swal.fire({
               title: "¿Desea registrar un nuevo usuario?",                    
               icon: "question",
               showCancelButton: true,
               confirmButtonColor: "#28B463",
               cancelButtonColor: "#5DADE2",
               confirmButtonText: "Confirmar",
               cancelButtonText: "Cancelar",

            }).then(function (result){

               if(result.isConfirmed){

                  if(nombres.trim() === '' || apellidos.trim() === '' ||
                  usuario.trim() === '' || contraseña.trim() === ''){

                     Swal.fire({
                        title: "Por favor, complete los campos",
                        icon: "warning",
                        confirmButtonColor: "#E43D2C",
                     });

                  }else{ 
                     $.ajax({
                        url: '../controllers/newusuario.controller.php',
                        type: 'POST',
                        data: dataR,
                        success: function(result){
                           Swal.fire({
                           title: 'Registro exitoso',                        
                           icon: 'success',
                           showConfirmButton: false,
                           timer: 1200
                           });

                           $("#form_newusuario")[0].reset();
                           window.location.href = `../index.php`;
                        }
                     });
                  
                  }
               }
         
            });
         }

         $("#btnRegistrar").click(usuariosRegistrar);







      });

      
   </script>


</body>

</html>