<?php
//Muestra las categorias de la base de datos

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    
    class Category_View extends PlantillaGerente{
     
      public function displayBody(){
        ?>
        <div class="contenido listas">
        <?php
        
        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();
        
        //Muestra las categorias
        $query = "SELECT * FROM categorias";
        $stmt = $db->prepare($query);  
        $stmt->execute();
        $stmt->store_result();
      
        $stmt->bind_result($id, $nombre, $tipo, $imagen);

        ?>
        <h3>Categorias encontradas: <?= $stmt->num_rows?></h3>
        <table class="table table-striped table-autosort">
          <thead>
            <tr class="bg-dark text-white">
              <th class="table-sortable:numeric">ID <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:alphanumeric">Nombre <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:alphanumeric">Tipo <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th>Imagen</th>
              <th></th>
              <th></th>
            </tr>
        </thead>
         <tbody>
        <?php
        //Imprime las categorias y los botones de eliminar y modificar
        while($stmt->fetch()) {
          ?>
          <tr>
            <td><?=$id?></td>
            <td><?=$nombre?></td>
            <td><?=$tipo?></td>
            <td><img src= "<?php echo "../uploads/".$imagen;?>" alt= "" width= "100" height= "75"/></td>
            <td><a href='categorias_modificar.php?id=<?=$id?>'> <button type='button' class='btn btn-success'>Modificar</button> </a></td>
            <td><a href='categorias_eliminar.php?id=<?=$id?>'> <button type='button' class='btn btn-danger'>Eliminar</button> </a></td>
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

  $category_View = new Category_View();

  $category_View -> display();
  $category_View -> displayBody();
  $category_View -> displayFooter();


  ?>

