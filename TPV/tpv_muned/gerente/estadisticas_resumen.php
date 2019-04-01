<?php
//Resumen de varias estadisticas de ventas de todos los empleados

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");
    
    class Statistics_View extends PlantillaGerente{
     
      public function displayBody(){
        ?>
		<div class="contenido listas">
        <?php

        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();


        ?>
      	<h3>Resumen del establecimiento</h3>

        <table class="table table-striped">
			<thead>
				<tr class="bg-dark text-white">
					<th>Top meses por importe</th>
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
				$query = "SELECT YEAR(fecha) AS ano, MONTH(fecha) AS mes, COUNT(ventaID) AS ventas, SUM(total) AS importe FROM ventas GROUP BY YEAR(fecha), MONTH(fecha) ORDER BY importe DESC";

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
					<th>Top meses por número de ventas</th>
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
				$query = "SELECT YEAR(fecha) AS ano, MONTH(fecha) AS mes, COUNT(ventaID) AS ventas, SUM(total) AS importe FROM ventas GROUP BY YEAR(fecha), MONTH(fecha) ORDER BY ventas DESC";

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
					<th>Top empleados por importe</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th scope= "col">Empleado</th>
					<th scope= "col">Ventas</th>
					<th scope= "col">Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				//Consulta los meses con mas ventas ordenados segun el importe de las mismas
				$query = "SELECT empleado AS empleado, COUNT(ventaID) AS ventas, SUM(total) AS importe FROM ventas GROUP BY empleado ORDER BY importe DESC";

		        $stmt = $db->prepare($query);  
		        $stmt->execute();	       
		        $stmt->store_result();	        
		        $stmt->bind_result($empleado, $ventas, $cantidad);

		        while($stmt->fetch()) {
		  			?>
			         <tr>
			           <td><?=$empleado; ?></td>
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
					<th>Top empleados por numero de ventas</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th scope= "col">Empleado</th>
					<th scope= "col">Ventas</th>
					<th scope= "col">Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				//Consulta los meses con mas ventas ordenados segun el importe de las mismas
				$query = "SELECT empleado AS empleado, COUNT(ventaID) AS ventas, SUM(total) AS importe FROM ventas GROUP BY empleado ORDER BY ventas DESC";

		        $stmt = $db->prepare($query);  
	
		        $stmt->execute();		       
		        $stmt->store_result();		        
		        $stmt->bind_result($empleado, $ventas, $cantidad);

		        while($stmt->fetch()) {
			        ?>
			         <tr>
			           <td><?=$empleado; ?></td>
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
					<th>Top productos por importe</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th scope= "col">Producto</th>
					<th scope= "col"abbr="">Ventas</th>
					<th scope= "col">Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				//Consulta los meses con mas ventas ordenados segun el importe de las mismas
				$query2 = "SELECT productoID AS producto, COUNT(productoID) AS ventas, SUM(precio*cantidad) AS importe FROM linea_venta GROUP BY productoID ORDER BY importe DESC";

		        $stmt = $db->prepare($query2);  
		        $stmt->execute();		       
		        $stmt->store_result();		        
		        $stmt->bind_result($productoID, $ventas, $cantidad);

		        while($stmt->fetch()) {

		        	$query3 = "SELECT nombre FROM productos WHERE productoID like $productoID ";
		        	$con = $db->prepare($query3); 
			        $con->execute();
			        $con->store_result();
			        $con->bind_result($producto);
			        $con->fetch()
				        ?>
				         <tr>
				           <td><?=$producto?></td>
				           <td><?=$ventas?></td>
				           <td><?php echo number_format($cantidad,2,',','.'); ?></td>
			        	</tr>

			            <?php
			            $con->free_result();
		        }

				?>
			</tbody>
		</table>

		<br><br>


		<table class="table table-striped">
			<thead >
				<tr class="bg-dark text-white">
					<th>Top productos por número de ventas</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th scope= "col">Producto</th>
					<th scope= "col">Ventas</th>
					<th scope= "col">Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				//Consulta los meses con mas ventas ordenados segun el importe de las mismas
				$query2 = "SELECT productoID AS producto, COUNT(productoID) AS ventas, SUM(precio*cantidad) AS importe FROM linea_venta GROUP BY productoID ORDER BY ventas DESC";

		        $stmt = $db->prepare($query2);  	
		        $stmt->execute();	       
		        $stmt->store_result();	        
		        $stmt->bind_result($productoID, $ventas, $cantidad);

		        while($stmt->fetch()) {

		        	$query3 = "SELECT nombre FROM productos WHERE productoID like $productoID ";
		        	$con = $db->prepare($query3); 
			        $con->execute();
			        $con->store_result();
			        $con->bind_result($producto);
			        $con->fetch()
				        ?>
				         <tr>
				           <td><?=$producto?></td>
				           <td><?=$ventas?></td>
				           <td><?php echo number_format($cantidad,2,',','.'); ?></td>
			        	</tr>

			            <?php
			            $con->free_result();
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
