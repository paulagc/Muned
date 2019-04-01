<?php
//Formulario para agregar productos

  require_once ("plantilla_gerente.php");
  require_once ("../database.php");

  class Inventory_Add extends PlantillaGerente
  {
      //Array que contendra los nombres de las categorias
      public $categorias = array();

      //Busca las categorias de la base de datos para mostrarlas en el formulario
      public function buscarCategorias(){
            //Conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();

            $query = "SELECT nombre FROM categorias";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->store_result();
          
            $stmt->bind_result($nombre);
            
            //Introduce las categorias en el array
            while($stmt->fetch()){

              array_push($this->categorias, $nombre);
            }
      }

      //Muestra el formulario para agregar producto
      public function displayBody(){
        ?>

        <div class="contenido texto">
          <h3>Agregar un producto</h3>
          <form action="inventario_agregado.php" method="post" enctype="multipart/form-data">

          <fieldset>
            <p><strong><label for="nombre">Nombre</label></strong>
            <input type="text" id="nombre" name="nombre" maxlength="20" size="20" required /></p>

            <p><strong><label for="precio">Precio con IVA</label></strong>
            <input type="text" id="precio" name="precio" maxlength="10" size="10" required /></p>

            <p><strong><label for="iva">IVA</label></strong>
            <input type="radio" name="iva" value="0"  /> 0%
            <input type="radio" name="iva" value="4" /> 4%
            <input type="radio" name="iva" value="10" /> 10%
            <input type="radio" name="iva" value="21" checked="checked"/> 21%

            <p><strong><label for="cantidad">Cantidad</label></strong>
              
            <input type="text" id="cantidad" name="cantidad" maxlength="10" size="10"  />
            En blanco para productos con stock infinito</p>

            <p><strong>Escoge categoría:</strong><br />
                <select name="categoria">
                <?php 
                  //Cada categoria es una opcion del panel
                  foreach ($this->categorias as $categoria) {
                    ?>
                    <option value="<?=$categoria?>"><?=$categoria?></option>

                    <?php

                  }

                ?>
                </select>
            </p>
            
            <p><strong><label for="foto">Foto: </label></strong>
            
            <input type= "file" name="foto" accept="image/*" /></p>
            <p>No debe exceder de 200kB y un nombre de máximo 20 caracteres</p>

          </fieldset>
          
          <p><input type="submit" value="Agregar producto" /></p>
          
          </form>
        </div>
        <?php

      }
  
  } 

  $inventory_add = new Inventory_Add();


  $inventory_add -> display();
  $inventory_add -> buscarCategorias();
  $inventory_add -> displayBody();
  $inventory_add -> displayFooter();

?>

