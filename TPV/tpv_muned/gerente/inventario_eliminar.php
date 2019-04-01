<?php
//Elimina el producto seleccionado

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    

    class Inventory_Delete extends PlantillaGerente{
      
      
      public function displayBody(){

        //Obtiene el id del producto a borrar, fue enviado en la url
        $consulta = $_GET['id'];

        
        ?>
        <div class="contenido  texto">
        <?php
        
        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();

        //Borra el producto con ese ID
        $query = 'DELETE FROM productos WHERE productoID = "'.$consulta.'"';
        $stmt = $db->prepare($query);  
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
                
        ?>
              <div class="alert alert-success" role="alert">El producto con ID <?= $consulta ?> ha sido eliminado en la base de datos</div>
              <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_ver.php"; ?>">
        <?php
        }else{

           ?>
                <div class="alert alert-danger" role="alert">Ha ocurrido un error, el producto con ID  <?=$consulta?> NO ha sido eliminado en la base de datos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_ver.php"; ?>">
            <?php
        }
       
        $db->close();
        ?>
      </div>
      <?php

    }
  }

  $inventario = new Inventory_Delete();


  $inventario -> display();
  
  $inventario -> displayBody();
  $inventario -> displayFooter();


  ?>

