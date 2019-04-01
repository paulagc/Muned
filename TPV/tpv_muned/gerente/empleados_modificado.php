<?php
//Modifica el empleado seleccionado

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");

    class Staff_Updated extends PlantillaGerente{


      public function displayBody(){
        ?>
        <div class="contenido  texto">
          <?php
          
            if (!isset($_POST['user']) || !isset($_POST['passwd']) || !isset($_POST['rol']) || !isset($_POST['nombre']) || !isset($_POST['dni']) || !isset($_POST['telef'])) {
               ?>
                    <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_ver.php"; ?>">
                <?php
               exit;
            }

            //Guarda las variables introducidas
            $user = $_POST['user'];
            $passwd=$_POST['passwd'];
            $rol=$_POST['rol'];
            $nombre=$_POST['nombre'];
            $dni=$_POST['dni'];
            $telef=$_POST['telef'];
            
            //Conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();
        

            //Busca el usuario y actualiza sus datos
            $query = 'UPDATE empleados SET passwd= "'.$passwd.'" , rol= "'.$rol.'", nombre= "'.$nombre.'", dni= "'.$dni.'", telefono= "'.$telef.'"  WHERE user = "'.$user.'" ';
          
            $stmt = $db->prepare($query);
            $stmt->bind_param($user, $passwd, $rol, $nombre, $dni, $telef);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                ?>
                <div class="alert alert-success" role="alert">El empleado <?=$user?> ha sido modificado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_ver.php"; ?>">
            <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, el empleado <?=$user?> NO ha sido modificado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."empleados_ver.php"; ?>">
            </div>
            <?php
            }
          
            $db->close();
      }
    }

    $staff = new Staff_Updated();


    $staff -> display();
    $staff -> displayBody();
    $staff -> displayFooter();


?>
