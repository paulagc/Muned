<?php
//Pagina principal de editar empleados
    require_once ("plantilla_gerente.php");
    class Staff extends PlantillaGerente{
      

      public function displayBody(){
        ?>
        <div class="container-fluid">
        <?php
        
        
        ?>
      </div>
      <?php
    }
  }

  $staff = new Staff();

  $staff -> content = "<section>
        <h2> Empleados </h2>
        </section>";

  $staff -> display();
  $staff -> displayMenu($staff -> buttons_empleados);
  $staff -> displayBody();
  $staff -> displayFooter();


  ?>

