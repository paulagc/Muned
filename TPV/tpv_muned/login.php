<?php
//Formulario de inicio de sesion
    require_once ("page.php");
    class Login extends Page{  
      
      //Muestra el body con el formulario
      public function displayBody(){
        ?>
        <div id="centrar">
        <div class="contenido">
       
        <div class="logo">
          <img src="<?=CSS_PATH."logo.png"?>" alt="" >
         
          <form method="post" action="logueado.php">

          <div class="formblock">
            <h2>Inicio de sesión de empleado</h2>

            <p><label for="user">Usuario:</label><br/>
            <input type="text" name="user" id="user" required/></p>

            <p><label for="passwd">Contraseña:</label><br/>
            <input type="password" name="passwd" id="passwd" required/></p>

            <button type="submit" style="height:50px;width:100px" class="boton">Log In</button>
            <p><br> </p>
            <p>¿No estás registrado? Solicita usuario al gerente o introduce <br>el usuario por defecto que encontrarás en el manual.</p>
          
          </div>

         </form>
        
        </div>
      
    </div>
      <?php
    }
  }

  $login = new Login();


  $login -> display();
  $login -> displayBody();
  $login -> displayFooter();


  ?>

