<?php
//Formulario para buscar una categoria
  require_once ("plantilla_gerente.php");

  class Category_Search extends PlantillaGerente
  {

    public function displayBody(){
    ?>
   <div class="contenido texto">
      <h3>Buscar una categoría</h3>
        <form action="categorias_buscado.php" method="post">
          <p><strong>Introduce nombre:</strong><br />
            <input name="nombre" type="text" size="40" required></p>

          <p><input type="submit" name="submit" value="Buscar"></p>
        </form>
      </div>
    <?php
    }
  }

  $category_Search = new Category_Search();

  $category_Search -> display();
  $category_Search -> displayBody();
  $category_Search -> displayFooter();



?>
