<?php
//Elimina la categoria siempre que no haya productos asociados a ella

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    

    class Category_Delete extends PlantillaGerente{
      
      
      public function displayBody(){

        //Obtiene el id del producto a borrar, fue enviado en la url
        $consulta = $_GET['id'];

        
        ?>
       <div class="contenido texto">
        <?php
        
        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();


        //Para poder eliminarlo no puede haber productos asociados a esa categoria
        $query = 'SELECT productoID FROM productos WHERE categoriaID = "'.$consulta.'" ';
        $stmt = $db->prepare($query);  
        $stmt->execute();
        $stmt->store_result();

        //Si hay productos asociados a la categoria, dar un aviso, sino eliminarla
        if($stmt->num_rows > 0){
          ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, la categoria <?=$nombre?> NO ha sido modificado en la base de datos, debe eliminar primero los productos asociados a ella.</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_ver.php"; ?>">
          <?php

        }else{
          
          $query2 = 'DELETE FROM categorias WHERE categoriaID = "'.$consulta.'"';
          $stmt2 = $db->prepare($query2);  
          $stmt2->execute();
          
          ?>
                <div class="alert alert-success" role="alert">La categoria ha sido eliminada en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_ver.php"; ?>">
          <?php
        

        }

        
        
        $db->close();
        ?>
      </div>
      <?php

    }
  }

  $category_Delete = new Category_Delete();

  $category_Delete -> display();
  $category_Delete -> displayBody();
  $category_Delete -> displayFooter();


  ?>

