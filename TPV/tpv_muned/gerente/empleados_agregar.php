<?php
//Fomulario para agregar empleados

  require_once ("plantilla_gerente.php");

  class Staff_Add extends PlantillaGerente
  {
  public function displayBody(){
    ?>

    <div class="contenido texto">
       <h3>Agregar empleado</h3>
      <form action="empleados_agregado.php" method="post">

      <fieldset>
        <p><strong><label for="usuario">Usuario</label></strong>
        <input type="text" id="usuario" name="usuario" maxlength="16" size="16" required /></p>

        <p><strong><label for="passwd">Contraseña</label></strong>
        <input type="text" id="passwd" name="passwd" maxlength="16" size="16" required /></p>

        <p><strong><label for="passwd2">Confirmar contraseña</label></strong>
        <input type="text" id="passwd2" name="passwd2" maxlength="16" size="16" required /></p>

        <p><strong><label for="rol">Rol</label></strong>
          <input type="radio" name="rol" value="camarero" checked="checked" /> Camarero
          <input type="radio" name="rol" value="gerente" /> Gerente
          
         <p><strong><label for="nombre">Nombre</label></strong>
        <input type="text" id="nombre" name="nombre" maxlength="20" size="20" required /></p>
        
        <p><strong><label for="dni">DNI</label></strong>
        <input type="text" id="dni" name="dni" maxlength="10" size="10" required /></p>
        
        <p><strong><label for="tel">Teléfono</label></strong>
        <input type="number" id="tel" name="tel" maxlength="10" size="10" required /></p>
        


      </fieldset>
      
      <p><input type="submit" value="Agregar empleado" /></p>
      

      </form>
    </div>
    <?php

  }
  
  } 

  $staff_add = new Staff_Add();

  $staff_add -> display();
  $staff_add -> displayBody();
  $staff_add -> displayFooter();

?>

