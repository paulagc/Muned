<?php
//Formulario para modificar categorias

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    

    class Category_Update extends PlantillaGerente{

      
      public function displayBody(){

        //Obtiene el id de la categoria a modificar, fue enviado en la url
        $consulta = $_GET['id'];
        
        ?>
       <div class="contenido texto">
         <h3>Modificar categoría ID: <?= $consulta?></h3>
        <?php
        
        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();

        //Consulta la categoria con ese ID para recuperar sus datos para el formulario y poder modificarlos
        $query = "SELECT * FROM categorias WHERE categoriaID = '$consulta'";
        $stmt = $db->prepare($query);  
        $stmt->execute();
        $stmt->store_result();
      
        $stmt->bind_result($id, $nombre, $tipo, $imagen);
      
        
        while($stmt->fetch()) {

        //Formulario con valores predefinidos a modificar, el id se muestra pero no se modifica
        ?>
          <form action="categorias_modificado.php" method="post" enctype="multipart/form-data">

          <fieldset>

            
            <p><label for="id">ID</label>
            <input type="text" id="id" name="id" maxlength="20" size="10" value="<?=$consulta?>" readonly = "readonly" /></p>

            <p><label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" maxlength="20" size="20" value="<?=$nombre?>" required /></p>

            <p><label for="tipo">Tipo </label>
            <input type="radio" name="tipo" value="bebida" checked="checked" /> Bebida
            <input type="radio" name="tipo" value="comida" /> Comida

            <p><label for="foto">Foto: </label>
            <input type= "file" name="foto" accept="image/*" />

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

  $category_Update = new Category_Update();


  $category_Update -> display();
  $category_Update -> displayBody();
  $category_Update -> displayFooter();


  ?>

