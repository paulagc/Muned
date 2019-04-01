<?php
//Formulario de busqueda de producto

  require_once ("plantilla_gerente.php");

  class Inventory_Search extends PlantillaGerente
  {

    public function displayBody(){
    ?>
    <div class="contenido texto">
      <h3>Buscar un producto</h3>
        <form action="inventario_buscado.php" method="post">
          <p><strong>Escoge campo de búsqueda:</strong><br />
            <select name="searchtype">
              <option value="nombre">Nombre</option>
              <option value="precio">Precio</option>
              <option value="cantidad">Cantidad</option>
              
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

  $inventario_buscar = new Inventory_Search();

  

  $inventario_buscar -> display();
 
  $inventario_buscar -> displayBody();
  $inventario_buscar -> displayFooter();



?>
