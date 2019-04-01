<?php
//Formulario para modificar un empleado
    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    

    class Staff_Update extends PlantillaGerente{
      
      public function displayBody(){

        //Obtiene el usuario a modificar, fue enviado en la url
        $consulta = $_GET['user'];

        
        ?>
        <div class="contenido  texto">
           <h3>Modificar empleado: <?= $consulta?></h3>
        <?php
        
        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();

        //Consulta el empleado con ese ID para recuperar sus datos para el formulario y poder modificarlos
        $query = "SELECT * FROM empleados WHERE user = '$consulta'";
        $stmt = $db->prepare($query);  
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user, $passwd, $rol, $nombre, $dni, $telefono);
    
        while($stmt->fetch()) {

        //Formulario con valores predefinidos a modificar, el id se muestra pero no se modifica
        ?>

          <form action="empleados_modificado.php" method="post">

          <fieldset>

            
            <p><label for="user">Usuario</label>
            <input type="text" id="user" name="user" maxlength="20" size="10" value="<?=$consulta?>" readonly = "readonly" /></p>

            <p><label for="passwd">Contraseña</label>
            <input type="text" id="passwd" name="passwd" maxlength="20" size="20"  required /></p>

            <p><label for="rol">Rol</label>
            <input type="radio" name="rol" value="camarero" checked="checked" /> Camarero
            <input type="radio" name="rol" value="gerente" /> Gerente

            <p><label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" maxlength="40" size="30" value="<?=$nombre?>" required /></p>

            <p><label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" maxlength="10" size="10" value="<?=$dni?>" required /></p>

            <p><label for="telef">Teléfono</label>
            <input type="text" id="telef" name="telef" maxlength="10" size="10" value="<?=$telef?>"  required/></p>


          </fieldset>
          
          <p><input type="submit" value="Guardar cambios" /></p>
          

          </form>


        <?php
        }

        $stmt->free_result();
        $db->close();
        ?>
      </div>
      <?php

    }
  }

  $staff = new Staff_Update();


  $staff -> display();
  $staff -> displayBody();
  $staff -> displayFooter();


  ?>

