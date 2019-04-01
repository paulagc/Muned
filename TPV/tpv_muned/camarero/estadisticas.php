<?php
//Pagina principal de estadisticas del camarero

    require_once ("plantilla_camarero.php");
    require_once ("../database.php");

    class Statistics extends PlantillaCamarero{


    }



  $stats = new Statistics();

  $stats -> content = "<section>
        <h2> Estadisticas </h2>
        </section>";

  $stats -> display();
  $stats -> displayMenu($stats -> buttons_estadisticas);
  
  $stats -> displayFooter();



 ?>