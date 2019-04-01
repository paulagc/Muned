<?php
//Modifica la categoria con los datos introducidos

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    class Category_Updated extends PlantillaGerente{


      public function displayBody(){
        ?>
        <div class="contenido  texto">
          <?php
          
            if (!isset($_POST['nombre'])|| !isset($_POST['tipo']) ) {
               ?>
                    <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_ver.php"; ?>">
                <?php
               exit;
            }

            //Guarda las variables modificadas
            $id = $_POST['id'];
            $nombre=$_POST['nombre'];
            $tipo = $_POST['tipo'];

            //Conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();

            //Limite de tamano para la foto
            $limite_kb = 200;

            //Comprobar si se ha cambiado la foto
            if(is_uploaded_file($_FILES["foto"]["tmp_name"])){

                //Si el nombre es demasiado grande la rechaza
                if(strlen($_FILES["foto"]["name"]) > 19){
                    ?>
                        <div class="alert alert-danger" role="alert">Nombre de archivo demasiado largo</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_ver.php"; ?>">
                    <?php
                    exit;
                //Si la foto es demasiado grande
                }elseif($_FILES["foto"]["size"] <= $limite_kb * 1024){
                     ?>
                        <div class="alert alert-danger" role="alert">La fotografia no puede exceder de 200kb</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_ver.php"; ?>">
                    <?php
                    exit;
                }else{
                    //Recupera el link de la foto anterior de la categoria
                    $query2 = 'SELECT imagen FROM categorias WHERE categoriaID = "'.$id.'"';
                    $stmt2 = $db->prepare($query2);
                    $stmt2->execute();
                    $stmt2->store_result();
                    $stmt2->bind_result($imagen);
                    $stmt2->fetch();

                    //Borrar foto anterior
                    $foto_anterior = UPLOADS_DOCUMENT_PATH.$imagen;
                    $borrado = unlink($foto_anterior);
                    //Mover foto nueva subida a la carpeta uploads
                    move_uploaded_file($_FILES["foto"]["tmp_name"], UPLOADS_DOCUMENT_PATH.$_FILES["foto"]["name"]);

                    //Actualizar la base de datos
                    $query = 'UPDATE categorias SET nombre = "'.$nombre.'", tipo = "'.$tipo.'" , imagen = "'.$_FILES["foto"]["name"].'" WHERE categoriaID = "'.$id.'"';
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                }

            //Si no se ha cambiado la foto    
            }else{

                //Busca la categoria y actualiza sus datos
                $query = 'UPDATE categorias SET nombre = "'.$nombre.'", tipo = "'.$tipo.'" WHERE categoriaID = "'.$id.'"';
                $stmt = $db->prepare($query);
                $stmt->execute();

            }
            
            


            if ($stmt->affected_rows > 0) {
                ?>
                <div class="alert alert-success" role="alert">La categoria <?=$nombre?> ha sido modificada en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_ver.php"; ?>">
            <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, la categoria <?=$nombre?> NO ha sido modificada en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_ver.php"; ?>">
            </div>
            <?php
            }
          
            $db->close();
      }
    }

    $category_Updated = new Category_Updated();


    $category_Updated -> display();
    $category_Updated -> displayBody();
    $category_Updated -> displayFooter();


?>
