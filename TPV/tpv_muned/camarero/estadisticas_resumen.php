<?php
//Estadisticas del usuario camarero activo

    require_once ("plantilla_camarero.php");
    require_once ("../database.php");
    
    class Statistics_View extends PlantillaCamarero{
     
      public function displayBody(){
        ?>
        <div class="contenido listas">
        <?php

        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();

        //Obtiene el nombre del empleado
		if (isset($_SESSION['camarero'])){

  			$empleado = $_SESSION['camarero'];

		}else{
			?>
			<div class="alert alert-danger" role="alert">Error, no hay usuario logueado</div>
			
			<?php
		}
        ?>
		<h3>Resumen del empleado: <?=$empleado?></h3>
        <table class="table table-striped">
			<thead >
				<tr class="bg-dark text-white">
					<th>Últimos meses por importe</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th scope= "col">Fecha</th>
					<th scope= "col">Ventas</th>
					<th scope= "col">Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php 

				//Consulta los meses con mas ventas ordenados segun el importe de las mismas
				$query = "SELECT YEAR(fecha) AS ano, MONTH(fecha) AS mes, COUNT(ventaID) AS ventas, SUM(total) AS importe FROM ventas WHERE empleado like '".$empleado."' GROUP BY YEAR(fecha), MONTH(fecha) ORDER BY importe DESC";
				
		        $stmt = $db->prepare($query);
		        $stmt->execute();
		        $stmt->store_result();
		        $stmt->bind_result($ano, $mes, $ventas, $cantidad);

		        while($stmt->fetch()) {
		    
			        ?>
			         <tr>
			           <td><?php echo $ano." / " .$mes; ?></td>
			           <td><?=$ventas?></td>
			           <td><?php echo number_format($cantidad,2,',','.'); ?></td>
		        	</tr>

		            <?php
		        }

				?>
			</tbody>
		</table>

		<br><br>

		<table class="table table-striped">
			<thead >
				<tr class="bg-dark text-white">
					<th>Últimos meses por número de ventas</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th scope= "col">Fecha</th>
					<th scope= "col">Ventas</th>
					<th scope= "col">Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				//Consulta los meses con mas ventas ordenados segun el importe de las mismas
				$query = "SELECT YEAR(fecha) AS ano, MONTH(fecha) AS mes, COUNT(ventaID) AS ventas, SUM(total) AS importe FROM ventas WHERE empleado = '".$empleado."' GROUP BY YEAR(fecha), MONTH(fecha) ORDER BY ventas DESC";

		        $stmt = $db->prepare($query);  
	
		        $stmt->execute();
		       
		        $stmt->store_result();
		        
		        $stmt->bind_result($ano, $mes, $ventas, $cantidad);


		        while($stmt->fetch()) {
		    
			        ?>
			         <tr>
			           <td><?php echo $ano." / " .$mes; ?></td>
			           <td><?=$ventas?></td>
			           <td><?php echo number_format($cantidad,2,',','.'); ?></td>
		        	</tr>

		            <?php
		        }

				?>
			</tbody>
		</table>


      </div>
      <?php
    }
  }

  $stats = new Statistics_View();

  $stats -> display();
  $stats -> displayBody();
  
  $stats -> displayFooter();


  ?>
