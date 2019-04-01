<?php
//Loguea al usuario o muestra error

    require_once ("page.php");
    require_once ("database.php");

    class Logged extends Page{
      
        //Inicia sesion segun rol
        function iniciarSesion($permiso, $persona){

          if(strcmp($permiso, "gerente") === 0){

            session_start();
            $_SESSION['gerente']="$persona";
            
   
          // Redirecciona al home de gerentes en 5 segundos 
           ?>
           <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=<?php echo GERENTE_PATH."home_gerente.php"; ?>"> 
           <?php
          

          }else if(strcmp($permiso, "camarero") === 0){

            session_start();
            $_SESSION['camarero']="$persona";

            

            // Redirecciona al home de camareros en 5 segundos 
            ?>
           <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=<?php echo CAMARERO_PATH."home_camarero.php"; ?>"> 
           <?php

           
          }else{
            ?>
                  <div class="alert alert-danger" role="alert">No se puede iniciar sesión</div>
                  <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo ROOT_PATH."login.php"; ?>">
            <?php
            exit;
          }

      }

      //Muestra el body
      public function displayBody(){
        /*?>
        <div id="centrar">
        <div class="contenido">
       
        <?php*/

        //Si no se enviaron todos los datos
        if (!isset($_POST['user']) || !isset($_POST['passwd']) ) {
              ?>
                  <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                  <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo ROOT_PATH."login.php"; ?>">
              <?php
               exit;
            }


          //Almacena variables usuario y contraseña
          $usuario=$_POST['user'];
          $passwd=$_POST['passwd'];


          //conexion a la base de datos
          $conexion = new Database();
          $db = $conexion ->conectar();



          //Busca el usuario en la base de datos de empleados
          $query = "SELECT user, passwd, rol FROM empleados WHERE user ='".$usuario."' AND passwd = '".$passwd."' ";
          $stmt = $db->prepare($query);  
          $stmt->execute();
          $stmt->store_result();
        
          $stmt->bind_result($user, $passwd, $rol);

          //Si hay resultados esta logueado correctamente
          if ($stmt->num_rows>0) {
             //Obtiene resultado
             $stmt->fetch();

             //Variable para iniciar sesion segun rol
             global $permiso;
             global $persona;
             $permiso = $rol;
             $persona = $user;
           
          } else {
              ?>
                  <div class="alert alert-danger" role="alert">Error iniciando sesión, usuario o contraseña incorrectos</div>
                  <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo ROOT_PATH."login.php"; ?>">
              <?php
             exit;
          }

          $stmt->free_result();
          $db->close();
        
        /*?>
      </div>
      </div>
      <?php*/
    }



  }

  $login = new Logged();

 
  
  //$login -> display();
  $login -> displayBody();
 //inicia sesion segun rol de camarero o gerente
  $login -> iniciarSesion($permiso, $persona);
  //$login -> displayFooter();


  ?>

