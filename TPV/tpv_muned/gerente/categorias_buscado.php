<?php
//Busca la categoria introducida en el formulario

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    
    class Category_Searched extends PlantillaGerente{
      

      public function displayBody(){
        ?>
        <div class="contenido texto">
        <?php
        
        //Guarda el parametro de busqueda
        $nombre = trim($_POST['nombre']);

        if (!$nombre) {
           ?>
                <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."categorias_buscar.php"; ?>">
            <?php
           exit;
        }


        //conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();

        //Recupera la categoria con el nombre introducido
        $query = "SELECT * FROM categorias WHERE nombre like '%$nombre%' ";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $nombre, $tipo, $imagen);



        //muestra los productos encontrados
        ?>
        <h3>Número de categorías encontradas: <?= $stmt->num_rows?></h3>
        <table class="table table-striped table-autosort">
          <thead>
            <tr class="bg-dark text-white" >
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

        //Imprime las categorias y los botones de modificar y eliminar por cada una
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

        $stmt->free_result();
        $db->close();
        ?>
      </div>
      <?php
    }
  }

  $category_Searched = new Category_Searched();

  $category_Searched -> display();
  $category_Searched -> displayBody();
  $category_Searched -> displayFooter();


  ?>

