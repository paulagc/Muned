<?php
//Borra el empleado seleccionado

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    

    class Staff_Delete extends Page{
      
      public function displayBody(){
        //Obtiene el id del producto a borrar, fue enviado en la url
        $consulta = $_GET['user'];


        
        ?>
        <div class="contenido texto">
        <?php

        //Si el empleado es el administrador no se puede eliminar, podrían borrar todos y no acceder
        if($consulta == 'admin'){
          ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, el empleado <?=$consulta?> NO se puede eliminar</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_ver.php"; ?>">
            <?php
        }else{
        
          //Conexion a la base de datos
          $conexion = new Database();
          $db = $conexion ->conectar();
          

          //Borra el usuario con ese id
          $query = 'DELETE FROM empleados WHERE user = "'.$consulta.'"';
          $stmt = $db->prepare($query);  
          $stmt->execute();
          if ($stmt->affected_rows > 0) {
                  
          ?>
                <div class="alert alert-success" role="alert">El empleado <?= $consulta ?> ha sido eliminado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_ver.php"; ?>">
          <?php
          }else{

             ?>
                  <div class="alert alert-danger" role="alert">Ha ocurrido un error, el empleado <?=$nombre?> NO ha sido eliminado en la base de datos</div>
                  <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_ver.php"; ?>">
              <?php
          }
         
         
          $db->close();
        }
        ?>

      </div>
      <?php

    }
  }

  $staff = new Staff_Delete();

  

  $staff -> display();
  $staff -> displayBody();
  $staff -> displayFooter();


  ?>

