<?php
//Muestra los productos del inventario
    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    
    class Inventory_View extends PlantillaGerente{
     
      //Imprime todos los productos y botones de modificar y eliminar
      public function displayBody(){
        ?>
        <div class="contenido listas">
          
        <?php

        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();
        
        //Muestra los productos y recupera el nombre de la categoria
        $query = "SELECT productos.productoID, categorias.nombre, productos.nombre, productos.precio, productos.iva, productos.cantidad, productos.imagen FROM productos JOIN categorias ON productos.categoriaID = categorias.categoriaID";
        $stmt = $db->prepare($query);  
        $stmt->execute();
        $stmt->store_result();
      
        $stmt->bind_result($id, $categoria, $nombre, $precio, $iva, $cantidad, $imagen);

       
        ?>
        <h3>Productos encontrados: <?= $stmt->num_rows?></h3>
        <table class="table table-striped table-autosort">
          <thead>
            <tr class="bg-dark text-white">
              <th class="table-sortable:numeric">ID <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:alphanumeric">Producto <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:alphanumeric">Categoria <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:numeric_comma">Precio CON IVA <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:numeric">IVA <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:numeric_comma">Precio SIN IVA <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:numeric">Cantidad <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th>Imagen</th>
              <th></th>
              <th></th>
            </tr>
        </thead>
         <tbody>
        <?php
        
        //Imprime los productos y los botones de modificar y eliminar por cada uno
        while($stmt->fetch()) {

          //Calcula el precio sin iva
          $precio_sin = ($precio/((100+$iva)/100));
          ?>
          <tr>
            <td><?=$id?></td>
            <td><?=$nombre?></td>
            <td><?=$categoria?></td>
            <td><?=number_format($precio,2,',','.')?></td>
            <td ><?=$iva?>%</td>
            <td><?=number_format($precio_sin,2,',','.')?></td>
            <td><?=$cantidad?></td>
            <td><img src= "<?php echo "../uploads/".$imagen;?>" alt= "" width= "100" height= "75"/></td>
            <td><a href='inventario_modificar.php?id=<?=$id?>'> <button type='button' class='btn btn-success'>Modificar</button> </a></td>
            <td><a href='inventario_eliminar.php?id=<?=$id?>'> <button type='button' class='btn btn-danger'>Eliminar</button> </a></td>
            </tr>
          <?php
        }
        ?>
          </tbody>
        </table>
        <?php

        $stmt->free_result();
        $db->close();
        ?>
        
      </div>
      <?php
    }
  }

  $inventario = new Inventory_View();

  

  $inventario -> display();
  $inventario -> displayBody();
  $inventario -> displayFooter();


  ?>

