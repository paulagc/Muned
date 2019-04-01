<?php
//Muestra todos los empleados del establecimiento

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");

    class Staff_View extends PlantillaGerente{

      public function displayBody(){
        ?>
        <div class="contenido listas">

        <?php
        
        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();
        
        //Consulta que recupera los empleados y su rol
        $query = "SELECT user, passwd, rol, nombre, dni, telefono FROM empleados";
        $stmt = $db->prepare($query);  
        
        $stmt->execute();
        $stmt->store_result();  
        $stmt->bind_result($user, $passwd, $rol, $nombre, $dni, $telefono);
        
        
        ?>
        <h3>Empleados encontrados: <?= $stmt->num_rows?></h3>
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
        
        //Imprime los empleados y los botones de modificar y eliminar por cada uno
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

  $staff = new Staff_View();

  $staff -> display();
  $staff -> displayBody();
  $staff -> displayFooter();


  ?>