<?php
//Formulario para modificar el producto seleccionado anteriormente

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    

    class Inventory_Update extends PlantillaGerente{

      //Array que contendra los nombres de las categorias
      public $categorias = array();

      //Busca las categorias de la base de datos para mostrarlas en el formulario
      public function buscarCategorias(){

            //conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();

            $query = "SELECT nombre FROM categorias";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->store_result();
          
            $stmt->bind_result($nombre);
            $hola = array();
            //Introduce las categorias en el array
            while($stmt->fetch()){

              array_push($this->categorias, $nombre);
            }


      }
      
      //Muestra el formulario
      public function displayBody(){

        //Obtiene el id del producto a modificar, fue enviado en la url
        $consulta = $_GET['id'];
        
        ?>
        <div class="contenido texto">
          <h3>Modificar producto ID: <?= $consulta?></h3>
        <?php
        
        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();

        //Recupera el producto con ese ID para obtener sus datos para el formulario y poder modificarlos
        $query = "SELECT * FROM productos WHERE productoID = '$consulta'";
        $stmt = $db->prepare($query);  
        $stmt->execute();
        $stmt->store_result();
      
        $stmt->bind_result($id, $cat, $nombre, $precio, $iva, $cantidad, $imagen);
      

        while($stmt->fetch()) {

        //Formulario con valores predefinidos a modificar, el id se muestra pero no se modifica
        ?>
          <form action="inventario_modificado.php" method="post" enctype="multipart/form-data">

          <fieldset>

            
            <p><label for="id">ID</label>
            <input type="text" id="id" name="id" maxlength="20" size="10" value="<?=$consulta?>" readonly = "readonly" /></p>

            <p><label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" maxlength="20" size="20" value="<?=$nombre?>" required /></p>

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


            <p><label for="precio">Precio con IVA</label>
            <input type="text" id="precio" name="precio" maxlength="10" size="10" value="<?=$precio?>"  required /></p>

            <p><label for="iva">IVA</label>
            <input type="radio" name="iva" value="0"  /> 0%
            <input type="radio" name="iva" value="4" /> 4%
            <input type="radio" name="iva" value="10" /> 10%
            <input type="radio" name="iva" value="21" checked="checked"/> 21%

            <p><label for="cantidad">Cantidad</label>
            <input type="text" id="cantidad" name="cantidad" maxlength="10" size="10" value="<?=$cantidad?>"  /></p>

            <p><label for="foto">Foto: </label>
            <input type= "file" name="foto" accept="image/*" />

          </fieldset>
          
          <p><input type="submit" value="Guardar cambios" /></p>
          

          </form>


        <?php
        }

        $stmt->free_result();
        $db->close();
        ?>
      </div>
      <?php

    }
  }

  $inventario = new Inventory_Update();


  $inventario -> display();
  $inventario -> buscarCategorias();
  $inventario -> displayBody();
  $inventario -> displayFooter();


  ?>

