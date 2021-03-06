<?php
//Fomulario para buscar estadisticas por fechas

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    
    class Statistics_Search extends PlantillaGerente{
     
      public function displayBody(){
        ?>
        <div class="contenido  texto">
          <h3>Buscar ventas for fechas</h3>
        <?php

        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();
        ?>

              <form name="formulario" method="post" action="estadisticas_buscado.php">         
                Desde:
              <input type="date" name="desde" step="1" min="2000-01-01" max="<?php echo date("Y-m-d");?>">

                Hasta:
                <input type="date" name="hasta" step="1" min="2000-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
              <p><input type="submit" value="Filtrar" /></p>
              
            </form>
        

        </div>
      <?php
    }
  }

  $stats = new Statistics_Search();

  $stats -> display();
  $stats -> displayBody();
  $stats -> displayFooter();


  ?>





