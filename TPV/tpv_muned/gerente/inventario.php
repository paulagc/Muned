<?php
//Pagina principal del inventario de productos
//
  require_once ("plantilla_gerente.php");

  class Inventory extends PlantillaGerente
  {
  }

  $inventory = new Inventory();

  $inventory -> content = "<section>
        <h2> Gestion de almacén </h2>
        </section>";

  $inventory -> display();
  $inventory -> displayMenu($inventory -> buttons_inventario);
  $inventory -> displayFooter();
?>
