<?php
//Pagina principal de estadisticas del panel de gerente

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");

    class Statistics extends PlantillaGerente{


    }


  $stats = new Statistics();


  $stats -> display();
  $stats -> displayFooter();



 ?>