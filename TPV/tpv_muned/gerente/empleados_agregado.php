<?php
//Agrega el empleado introducido a la base de datos

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    
    class Staff_Added extends PlantillaGerente{


      public function displayBody(){
        ?>
       <div class="contenido texto">
          <?php


            if (!isset($_POST['usuario']) || !isset($_POST['passwd']) 
                 || !isset($_POST['passwd2']) || !isset($_POST['rol'])
                 || !isset($_POST['nombre'])|| !isset($_POST['dni']) || !isset($_POST['tel'])) {
               ?>
                    <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_agregar.php"; ?>">
                <?php
               exit;
            }

            // Guarda los datos introducidos en variables
            $usuario=$_POST['usuario'];
            $passwd=$_POST['passwd'];
            $passwd2=$_POST['passwd2'];
            $rol=$_POST['rol'];
            $nombre=$_POST['nombre'];
            $dni=$_POST['dni'];
            $telefono=$_POST['tel'];

            //Si la contraseña y su repeticion no coincide
            if ($passwd != $passwd2) {
              ?>
                    <div class="alert alert-danger" role="alert">Las contraseñas no coinciden</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_agregar.php"; ?>">
                <?php
              exit;
            }

            // Comprueba que el largo de la contraseña este entre 6 y 16 caracteres
            if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
              ?>
                    <div class="alert alert-danger" role="alert">La contraseña debe tener entre 6 y 16 caracteres</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_agregar.php"; ?>">
              <?php
              
              exit;
            }

            //Conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();
        
            //Inserta el usuario introducido
            $query = "INSERT INTO empleados (user, passwd, rol, nombre, dni, telefono) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('sssssi', $usuario, $passwd, $rol, $nombre, $dni, $telefono);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                ?>
                <div class="alert alert-success" role="alert">El empleado <?=$usuario?> ha sido insertado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_ver.php"; ?>">
            <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, el empleado <?=$usuario?> NO ha sido insertado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_agregar.php"; ?>">
            </div>
            <?php
            }
          
            $db->close();
      }
    }

    $staff_add = new Staff_Added();
    $staff_add -> display();
    $staff_add -> displayBody();
    $staff_add -> displayFooter();


?>