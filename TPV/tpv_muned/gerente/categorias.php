<?php
//Pagina principal de la gestion de categorias
  require_once ("plantilla_gerente.php");

  class Category extends PlantillaGerente
  {
  }

  $category = new Category();

  $category -> content = "<section>
        <h2> Gestion de categorias </h2>
        </section>";

  $category -> display();
  $category -> displayMenu($category -> buttons_categorias);
  $category -> displayFooter();
?>
