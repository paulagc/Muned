<?php
//Formulario para agregar una categoria
  require_once ("plantilla_gerente.php");
  require_once ("../database.php");

  class Category_Add extends PlantillaGerente
  {
    

      public function displayBody(){
        ?>

       <div class="contenido texto">
        <h3>Agregar una categoría</h3>
          <form action="categorias_agregado.php" method="post" enctype="multipart/form-data">

          <fieldset>
            <p><strong><label for="nombre">Nombre</label></strong>
            <input type="text" id="nombre" name="nombre" maxlength="20" size="20" required /></p>

            <p><strong><label for="tipo">Tipo: </label></strong>
            <input type="radio" name="tipo" value="bebida" checked="checked" /> Bebida
            <input type="radio" name="tipo" value="comida" /> Comida

            <p><strong><label for="foto">Foto: </label></strong>
            <input type= "file" name="foto" accept="image/*" /></p>
            <p>No debe exceder de 200kB y un nombre de máximo 20 caracteres</p>
            
          </fieldset>
          
          <p><input type="submit" value="Agregar categoria" /></p>
          

          </form>
        </div>
        <?php

      }
  
  } 

  $category_add = new Category_Add();

  $category_add -> display();
  $category_add -> displayBody();
  $category_add -> displayFooter();

?>

