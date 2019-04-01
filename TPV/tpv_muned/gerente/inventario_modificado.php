<?php
//Modifica el producto en la base de datos

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");

    class Inventory_Updated extends PlantillaGerente{


      public function displayBody(){
        ?>
        <div class="contenido  texto">
          <?php
          
            if (!isset($_POST['nombre']) || !isset($_POST['precio']) || !isset($_POST['iva'])
                 ||  !isset($_POST['categoria'])) {
                    ?>
                        <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_ver.php"; ?>">
                    <?php
               exit;
            }

            // Almacena las variables introducidas
            $id = $_POST['id'];
            $nombre=$_POST['nombre'];
            $precio=$_POST['precio'];
            $precio=str_replace(',', '.', $precio);
            $iva=$_POST['iva'];
            $categoria=$_POST['categoria'];

            //Si no se indica cantidad se considera stock infinito y se marca como null
            if(!isset($_POST['cantidad'])|| !is_numeric($_POST['cantidad'])){
                $cantidad= null;
                
            }else{
                $cantidad=$_POST['cantidad'];
                
            }
            
            //Conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();


            //Busca el id de categoria
            $query = "SELECT categoriaID FROM categorias WHERE nombre like '%$categoria%'";
        
            $stmt = $db->prepare($query); 
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($categoriaID);
            $stmt->fetch();

            //Comprobar si se ha cambiado la foto
            if(is_uploaded_file($_FILES["foto"]["tmp_name"])){

                //Si el nombre es demasiado grande la rechaza
                if(strlen($_FILES["foto"]["name"]) > 19){

                    ?>
                        <div class="alert alert-danger" role="alert">Nombre de archivo demasiado largo</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_ver.php"; ?>">
                    <?php
                    
                    exit;

                //Si la foto es demasiado grande
                }elseif($_FILES["foto"]["size"] <= $limite_kb * 1024){
                    ?>
                        <div class="alert alert-danger" role="alert">La fotografia no puede exceder de 200kb</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_ver.php"; ?>">
                    <?php
                    exit;

                }else{
                    //Recupera el link de la foto anterior del producto
                    $query3 = 'SELECT imagen FROM productos WHERE productoID = "'.$id.'"';
                    $stmt3 = $db->prepare($query3);
                    $stmt3->execute();
                    $stmt3->store_result();
                    $stmt3->bind_result($imagen);
                    $stmt3->fetch();

                    //Borrar foto anterior
                    $foto_anterior = UPLOADS_DOCUMENT_PATH.$imagen;
                    $borrado = unlink($foto_anterior);
                    //Mover foto nueva subida a la carpeta uploads
                    move_uploaded_file($_FILES["foto"]["tmp_name"], UPLOADS_DOCUMENT_PATH.$_FILES["foto"]["name"]);

                    //Actualizar la base de datos
                    $query2 = 'UPDATE productos SET nombre= "'.$nombre.'", categoriaID = "'.$categoriaID.'", precio= "'.$precio.'" , iva = "'.$iva.'" , cantidad = "'.$cantidad.'" , imagen = "'.$_FILES["foto"]["name"].'" WHERE productoID = "'.$id.'" ';
                  
                    $stmt2 = $db->prepare($query2);
                    $stmt2->execute();
                }

            //Si no se cambio la imagen
            } else{
                
                //si la cantidad es null la sentencia es diferente
                if($cantidad == null){

                    //Busca el producto y actualiza sus datos
                    $query2 = 'UPDATE productos SET nombre= "'.$nombre.'", categoriaID = "'.$categoriaID.'", precio= "'.$precio.'" , iva = "'.$iva.'" , cantidad = NULL  WHERE productoID = "'.$id.'" ';
                  
                    $stmt2 = $db->prepare($query2);
                    $stmt2->execute();

                }else{

                    //Busca el producto y actualiza sus datos
                    $query2 = 'UPDATE productos SET nombre= "'.$nombre.'", categoriaID = "'.$categoriaID.'", precio= "'.$precio.'" , iva = "'.$iva.'" , cantidad = "'.$cantidad.'"  WHERE productoID = "'.$id.'" ';
                  
                    $stmt2 = $db->prepare($query2);
                    $stmt2->execute();

                }

                

            }
            

            //Emite mensaje de si el producto se modifico correctamente o hubo un error
            if ($stmt2->affected_rows > 0) {
                ?>
                <div class="alert alert-success" role="alert">El producto <?=$nombre?> ha sido modificado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_ver.php"; ?>">
            <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, el producto <?=$nombre?> NO ha sido modificado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_ver.php"; ?>">
            
            <?php
            }
          
            $db->close();
            ?>
            </div>
            
            <?php
      }
    }

    $inventario = new Inventory_Updated();


    $inventario -> display();
    
    $inventario -> displayBody();
    $inventario -> displayFooter();


?>
