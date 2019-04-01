<?php
//Agrega la categoria introducida
    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    require_once ("../dirs.php");

    class Category_Added extends PlantillaGerente{


      public function displayBody(){
        ?>
       <div class="contenido texto">
          <?php
            if (!isset($_POST['nombre'])|| !isset($_POST['tipo'])) {
               ?>
                    <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_agregar.php"; ?>">
                <?php
               exit;
            }

            //Guarda el nombre y tipo introducidos
            $nombre = $_POST['nombre'];
            $tipo = $_POST['tipo'];

            //Comprueba que se haya subido la imagen
            if(is_uploaded_file($_FILES["foto"]["tmp_name"])){
                

                //Si el nombre es demasiado grande la rechaza
                if(strlen($_FILES["foto"]["name"]) > 19){
                    ?>
                        <div class="alert alert-danger" role="alert">Nombre de archivo demasiado largo</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_agregar.php"; ?>">
                    <?php
                    exit;
                //Si la foto es demasiado grande
                }elseif($_FILES["foto"]["size"] <= $limite_kb * 1024){
                    ?>
                        <div class="alert alert-danger" role="alert">La fotografia no puede exceder de 200kb</div>
                        <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_agregar.php"; ?>">
                    <?php
                    exit;
                }
            }else{
                ?>
                    <div class="alert alert-danger" role="alert">No hay imagen</div>
                    <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_agregar.php"; ?>">
                <?php
                exit;
            }


            //Conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();

            /*//Lee la imagen y obtiene sus proporciones
            $img_original = imagecreatefromjpeg($_FILES["foto"]["tmp_name"]);
            $img_original_x = imagesx($img_original);
            $img_original_y = imagesy($img_original);

            //Crea imagen redimensionada y sus proporciones en pixels
            $img_resize_x = 50;
            $img_resize_y = 50;
            $img_resize = imagecreatetruecolor($img_resize_x, $img_resize_y);

            //Redimensiona la imagen
            imagecopyresized($img_resize, $img_original, 0, 0 ,0 ,0, $img_resize_x, $img_resize_y, $img_original_x, $img_original_y);

            header("Content-Type: image/jpeg");
            imagejpeg($img_resize, NULL, 100);*/

            //Mueve la foto al directorio de archivos subidos
           move_uploaded_file($_FILES["foto"]["tmp_name"], UPLOADS_DOCUMENT_PATH.$_FILES["foto"]["name"]);
            //move_uploaded_file($img_resize, UPLOADS_PATH.$_FILES["foto"]["name"]);
            
            
            //Inserta la categoria en la base de datos y asocia la imagen con su nombre
            $query2 = "INSERT INTO categorias (nombre, tipo, imagen) VALUES (?, ?, ?)";
            $stmt2 = $db->prepare($query2);
            $stmt2->bind_param('sss', $nombre, $tipo, $_FILES["foto"]["name"]);
            $stmt2->execute();
            
            //Indica si se ha guardado la categoria
            if ($stmt2->affected_rows > 0) {
                ?>
                <div class="alert alert-success" role="alert">La categoria <?=$nombre?> ha sido insertada en la base de datos</div>
                <div>
                    <img src= "<?php echo "../uploads/".$_FILES["foto"]["name"];?>" alt= "" width= "200" height= "200" />
                </div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_ver.php"; ?>">
            <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, la categoria <?=$nombre?> NO ha sido insertada en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_agregar.php"; ?>">
            </div>
            <?php
            }
          
            $db->close();
      }
    }

    $category_Added = new Category_Added();
    $category_Added -> display();
    $category_Added -> displayBody();
    $category_Added -> displayFooter();


?>
