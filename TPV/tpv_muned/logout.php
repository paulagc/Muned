<?php
//Cierra una sesion de usuario

session_start();

    require ("page.php");

    class Logout extends Page{

      
        //Cierra la sesion, comprueba primero que tipo de rol es
        function logout(){
           ?>
              <div id="centrar">
            <?php
          if(isset($_SESSION['gerente'])){

              unset($_SESSION['gerente']);
              

          }else if(isset($_SESSION['camarero'])){
            
           
            unset($_SESSION['camarero']);

          }

          // Redirecciona a la pagina de login en 5 segundos 
            ?>
           <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=<?php echo ROOT_PATH."login.php"; ?>"> 
           <?php
              

        }





  }

  $login = new Logout();

  $login -> display();
  
  $login -> logout();
  //$login -> displayFooter();


  ?>

