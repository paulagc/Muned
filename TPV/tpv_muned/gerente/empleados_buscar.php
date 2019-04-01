<?php
//Formulario para buscar empleados

  require_once ("plantilla_gerente.php");

  class Staff_Search extends PlantillaGerente
  {

    public function displayBody(){
    ?>
    <div class="contenido texto">
      <h3>Buscar un empleado</h3>
        <form action="empleados_buscado.php" method="post">
          <p><strong>Escoge campo de búsqueda:</strong><br />
            <select name="searchtype">
              <option value="user">Usuario</option>
              <option value="rol">Rol</option>
              <option value="nombre">Nombre</option>
              <option value="dni">DNI</option>
              <option value="telef">Teléfono</option>
            </select>
          </p>
          <p><strong>Introducir texto:</strong><br />
            <input name="searchterm" type="text" size="40" required></p>

          <p><input type="submit" name="submit" value="Buscar"></p>
        </form>
      </div>
    <?php
    }
  }

  $staff = new Staff_Search();

  $staff -> display();
  $staff -> displayBody();
  $staff -> displayFooter();



?>
