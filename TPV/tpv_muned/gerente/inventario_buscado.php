<?php
//Busca el producto introducido

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    
    class Inventory_Searched extends PlantillaGerente{
      

      public function displayBody(){
        ?>
        <div class="contenido listas">
        <?php

        //Guarda el texto a buscar y la seccion en la que buscar
        $searchtype=$_POST['searchtype'];
        $searchterm=trim($_POST['searchterm']);
        //En caso de que sea precio, reemplaza comas por puntos en los decimales
        $searchterm=str_replace(',', '.', $searchterm);

        //Si falta algun dato 
        if (!$searchtype || !$searchterm) {
           ?>
                <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_buscar.php"; ?>">
            <?php
           exit;
        }

        //Comprueba que el tipo de busqueda sea un atributo valido
        switch ($searchtype) {
          case 'nombre':
          case 'precio':
          case 'cantidad':   
            break;
          default: 
            ?>
                <div class="alert alert-danger" role="alert">No se han introducido los datos correctos</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_buscar.php"; ?>">
            <?php
            exit; 
        }  

        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();

        //Busca el producto cuyo atributo seleccionado corresponda con ese texto o incluya parte de el
        $query = "SELECT * FROM productos WHERE $searchtype like '%$searchterm%'";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $categoria, $nombre, $precio, $iva, $cantidad, $imagen);

        

        //Muestra los productos encontrados
        ?>
        <h3>Número de productos encontrados: <?= $stmt->num_rows?></h3>
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
            <td><?=$iva?>%</td>
            <td><?=number_format($precio_sin,2,',','.')?></td>
            <td><?=$cantidad?></td>
            <td><img src= "<?php echo "../uploads/".$imagen;?>" alt= "" width= "100" height= "75"/></td>
            <td><a href='inventario_modificar.php?id=<?=$id?>'> <button type='button' class='btn btn-success'>Modificar</button> </a></td>
            <td><a href='inventario_eliminar.php?id=<?=$id?>'> <button type='button' class='btn btn-danger'>Eliminar</button> </a></td>
          <?php
        }

        $stmt->free_result();
        $db->close();
        ?>
      </div>
      <?php
    }
  }

  $inventario = new Inventory_Searched();


  $inventario -> display();

  $inventario -> displayBody();
  $inventario -> displayFooter();


  ?>

