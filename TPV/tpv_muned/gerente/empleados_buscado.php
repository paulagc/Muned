<?php
//Busca el usuario introducido en el formulario

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");

    class Staff_Searched extends PlantillaGerente{
      

      public function displayBody(){
        ?>
        <div class="contenido texto">
        <?php
        //Crea las variables de busqueda en un campo con un texto determinado
        $searchtype=$_POST['searchtype'];
        $searchterm=trim($_POST['searchterm']);

        if (!$searchtype || !$searchterm) {
           ?>
                <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
                <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."inventario_buscar.php"; ?>">
            <?php
           
           exit;
        }

        //Comprueba que el tipo de busqueda sea un atributo de la base de datos
        switch ($searchtype) {
          case 'user':
          case 'rol':
          case 'nombre':
          case 'dni':
          case 'telef':
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
        
        //Recupera el usuario con los parametros de busqueda introducidos
        $query = "SELECT * FROM empleados WHERE $searchtype like '%$searchterm%'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
  
        $stmt->bind_result($user, $passwd, $rol, $nombre, $dni, $telefono);

        

        ?>
        <h3>Número de empleados encontrados: <?= $stmt->num_rows?></h3>
        <table class="table table-striped table-autosort">
          <thead>
            <tr class="bg-dark text-white">
              <th class="table-sortable:alphanumeric">Usuario <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:alphanumeric">Rol <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:alphanumeric">Nombre <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:alphanumeric">DNI <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th class="table-sortable:numeric">Teléfono <i class="fa fa-caret-up fa-lg"></i><i class="fa fa-caret-down fa-lg"></i></th>
              <th></th>
              <th></th>
            </tr>
        </thead>
         <tbody>
        <?php
        //Imprime el usuario y los botones de modificar y eliminar
        while($stmt->fetch()) {
          ?>
          <tr>
            <td><?=$user?></td>
            <td><?=$rol?></td>
            <td><?=$nombre?></td>
            <td><?=$dni?></td>
            <td><?=$telefono?></td>
            <td><a href='empleados_modificar.php?user=<?=$user?>'> <button type='button' class='btn btn-success'>Modificar</button> </a></td>
            <td><a href='empleados_eliminar.php?user=<?=$user?>'> <button type='button' class='btn btn-danger'>Eliminar</button> </a></td>
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

  $staff = new Staff_Searched();

  $staff -> display();
  $staff -> displayBody();
  $staff -> displayFooter();


  ?>

