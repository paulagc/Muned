<?php
//Agrega el producto a la base de datos

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");

    class Inventory_Added extends PlantillaGerente{


      public function displayBody(){
        ?>
        <div class="contenido  texto">
          <?php

            //Si falta algun apartado mostrar mensaje
            if (!isset($_POST['nombre']) || !isset($_POST['precio']) || !isset($_POST['iva'])
                 ||  !isset($_POST['categoria'])) {
               ?>
                    <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_agregar.php"; ?>">
                <?php
               exit;
            }

            //Guarda las variables introducidas
            $nombre=$_POST['nombre'];
            $precio=$_POST['precio'];
            $precio = str_replace(',', '.', $precio);
            $iva=$_POST['iva'];
            $categoria=$_POST['categoria'];

            //Si no se indica cantidad se considera stock infinito y se marca como null
            if(!isset($_POST['cantidad'])|| !is_numeric($_POST['cantidad'])){
                $cantidad= null;
            }else{
                $cantidad=$_POST['cantidad'];
            }
            
            //Comprueba que se haya subido la imagen
            if(is_uploaded_file($_FILES["foto"]["tmp_name"])){
                

                //Si el nombre es demasiado grande la rechaza
                if(strlen($_FILES["foto"]["name"]) > 19){
                    ?>
                        <div class="alert alert-danger" role="alert">Nombre de archivo demasiado largo</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_agregar.php"; ?>">
                    <?php
                    exit;
                //Si la foto es demasiado grande
                }elseif($_FILES["foto"]["size"] <= $limite_kb * 1024){
                    ?>
                        <div class="alert alert-danger" role="alert">La fotografia no puede exceder de 200kb</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_agregar.php"; ?>">
                    <?php
                    exit;
                }
            }else{
                ?>
                    <div class="alert alert-danger" role="alert">No hay imagen</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_agregar.php"; ?>">
                <?php
                exit;
            }


            //Conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();

           //Recupera el ID de la categoria seleccionada 
            $query = "SELECT categoriaID FROM categorias WHERE nombre = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param('s', $categoria);
            $stmt->execute();
            $stmt->store_result();
          
            $stmt->bind_result($categoriaID);
            $stmt->fetch();

            //Mueve la foto al directorio de archivos subidos
            move_uploaded_file($_FILES["foto"]["tmp_name"], UPLOADS_DOCUMENT_PATH.$_FILES["foto"]["name"]);

            //Inserta el producto en la base de datos
            $query2 = "INSERT INTO productos (categoriaID, nombre, precio, iva, cantidad, imagen) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt2 = $db->prepare($query2);
           
            $stmt2->bind_param('isdiis', $categoriaID, $nombre, $precio, $iva, $cantidad, $_FILES["foto"]["name"]);
            
            $stmt2->execute();
            if ($stmt2->affected_rows > 0) {
                ?>
                <div class="alert alert-success" role="alert">El producto <?=$nombre?> ha sido insertado en la base de datos</div>
                <div>
                    <img src= "<?php echo "../uploads/".$_FILES["foto"]["name"];?>" alt= "" width= "200" height= "200" />
                </div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_ver.php"; ?>">
            <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, el producto <?=$nombre?> NO ha sido insertado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_agregar.php"; ?>">
            
            <?php
            }
          ?>
          </div>
          <?php
            $db->close();
      }
    }

    $inventario_add = new Inventory_Added();

    $inventario_add -> display();
    $inventario_add -> displayBody();
    $inventario_add -> displayFooter();


?>
