<?php
//Posterior a la confirmacion del carrito, crea una venta en la base de datos

require_once("sesion.php");
require_once("carrito.php");
require_once("plantilla_venta.php");
require_once ("database.php");


class Cobro extends PlantillaVenta {

	public $cart = array();
	public $ventaID;
	public $fecha;
	public $total = 0;

	//Muestra la venta
	public function imprimirTicket(){

		$base_imponible_0 = 0;
		$base_imponible_4 = 0;
		$base_imponible_10 = 0;
		$base_imponible_21 = 0;
		$iva_0 = 0;
		$iva_4 = 0;
		$iva_10 = 0;
		$iva_21 = 0;

		
    	?>

    	<div class="contenido">
    		<div id="imprimir">
    		
    		<table class="table table-striped" >
						<thead>
							<tr class="bg-dark text-white">
								<th colspan="6">Ticket nº <?=  $this->ventaID ?></th>
							</tr>
							<tr>
								<th scope= "col" align="left">Cantidad</th>
								<th scope= "col" align="left">Producto</th>
								<th scope= "col" align="left">Precio</th>
								<th scope= "col" align="left">Subtotal</th>
								<th scope= "col" align="left">IVA</th>
		                  	</tr>

		                </thead>

						<tbody>

    	<?php

		if(!empty($this->cart)){
				foreach ($this->cart as $linea){
					?>
					
							 <tr>
							 	<td><?=$linea['amount']?></td>
								<td><?=$linea['product']?></td>
								<td><?=number_format($linea['price'],2,',','.')?></td>
								<td><?=number_format($linea['subtotal'],2,',','.')?></td>
								<td><?=$linea['iva']?></td>
							</tr>
						
					<?php
					//Va sumando los datos para el iva y la base imponible
					if($linea['iva'] == 0){
						$precio_sin = round(($linea['price']/ ((100 + $linea['iva'])/ 100)), 2);
						$base_imponible_0 += round($precio_sin*$linea['amount'], 2);
						$iva_0 += round(($linea['price'] - $precio_sin)*$linea['amount'], 2);

					}elseif($linea['iva'] == 4){
						$precio_sin = round(($linea['price']/ ((100 + $linea['iva'])/ 100)), 2);
						$base_imponible_4 += round($precio_sin, 2);
						$iva_4 += round(($linea['price'] - $precio_sin)*$linea['amount'], 2);

					}elseif($linea['iva'] == 10){
						$precio_sin = round(($linea['price']/ ((100 + $linea['iva'])/ 100)), 2);
						$base_imponible_10 += round($precio_sin*$linea['amount'], 2);
						$iva_10 += round(($linea['price'] - $precio_sin)*$linea['amount'], 2);
						

					}elseif($linea['iva'] == 21){
						$precio_sin = round(($linea['price']/ ((100 + $linea['iva'])/ 100)), 2);
						$base_imponible_21 += round($precio_sin*$linea['amount'], 2);
						$iva_21 += round(($linea['price'] - $precio_sin)*$linea['amount'], 2);
					}
				}
		}

		?>
			</tbody>
			<p><br> </p>
			<tfoot>
				
				<tr class="bg-dark text-white">
					<th align="left">Tipo %</th>
					<th align="left">Base imponible</th>
					<th align="left">IVA</th>
					<th align="left">Total</th>
				</tr>
				<tr>
					<td>0%</td>
					<td><?=number_format($base_imponible_0,2,',','.')?></td>
					<td><?=number_format($iva_0,2,',','.')?></td>
					<td><?=number_format($base_imponible_0+$iva_0,2,',','.')?></td>
				</tr>
				<tr>
					<td>4%</td>
					<td><?=number_format($base_imponible_4,2,',','.')?></td>
					<td><?=number_format($iva_4,2,',','.')?></td>
					<td><?=number_format($base_imponible_4+$iva_4,2,',','.')?></td>
				</tr>
				<tr>
					<td>10%</td>
					<td><?=number_format($base_imponible_10,2,',','.')?></td>
					<td><?=number_format($iva_10,2,',','.')?></td>
					<td><?=number_format($base_imponible_10+$iva_10,2,',','.')?></td>
				</tr>
				<tr>
					<td>21%</td>
					<td><?=number_format($base_imponible_21,2,',','.')?></td>
					<td><?=number_format($iva_21,2,',','.')?></td>
					<td><?=number_format($base_imponible_21+$iva_21,2,',','.')?></td>
				</tr>

			</tfoot>
			
		</table>

			<div class="totales">
				<h5 class="titulo">TOTAL: </h5>
				<h5 class="euros"><?=$this->total?> €</h5>
			  	<h5 class="titulo">ENTREGADO: </h5>
				<h5 class="euros"><?= $this->total + $_GET['devol'] ?> €</h5>
				<h5 class="titulo">CAMBIO: </h5>
				<h5 class="euros"><?= $_GET['devol']?> €</h5>
				
			</div>

		
		<button class="boton" onClick="genPDF();">Imprimir ticket</button>
		</div>
		</div>

		<?php




		}

		//Crea la venta en la base de datos
		public function crearVenta(){

			if(isset($_SESSION['cart'])){
    			$this->cart = $_SESSION['cart'];

	    	//Si no hay nada en el carro devuelve a ventas
	    	}else{
	    		header('Location: ventas.php');
	    	}


			//conexion a la base de datos
            $conexion = new Database();
            $db = $conexion ->conectar();


            //Obtiene nombre de empleado
            if (isset($_SESSION['gerente']))  {
            	
	      		$empleado = $_SESSION['gerente'];

	  		} else if (isset($_SESSION['camarero'])){

	  			$empleado = $_SESSION['camarero'];

			}else{

				echo "Error, no hay usuario logueado";
			}

			//Obtiene total
			echo "aqui0";
	    	if(!empty($this->cart)){
	    		echo "aqui1";
	    		foreach ($this->cart as $linea){
	    			echo "aqui2";
					$this->total += $linea['subtotal'];
					echo " subtotal ".$linea['subtotal'];
				}
	    	}

	    	echo "total" .$this->total;

	    	//Obtiene fecha
	    	date_default_timezone_set('Europe/Madrid');
	    	$this->fecha = date("Y-m-d H:i:s");
	    	

	    	//Inserta la venta en la base de datos
            $query = "INSERT INTO ventas (empleado, total, fecha) VALUES (?, ?, ? )";
            $stmt = $db->prepare($query);
            $stmt->bind_param('sds', $empleado, $this->total, $this->fecha);
            $stmt->execute();
            if ($stmt->affected_rows < 0) {
                ?>
                <div class="alert alert-danger" role="alert">Venta insertada en la base de datos, importe: <?=$this->total?>, empleado: <?=$empleado?>, fecha: <?=$this->fecha?></div>
            <?php
        	}
        	$stmt->free_result();


	        //Id de la venta que se acaba de registrar
	        $this->ventaID = $stmt->insert_id;

	        //Bucle que inserta las lineas de cada producto en la venta y actualiza el inventario
	        if(!empty($this->cart)){
	        	echo "aqui 9";
				foreach ($this->cart as $line){

					$query = "INSERT INTO linea_venta (ventaID, productoID, precio, iva, cantidad) VALUES (?, ?, ?, ?, ? )";
		            $con = $db->prepare($query);
		            $con->bind_param('iidii', $this->ventaID, $line['code'], $line['price'], $line['iva'], $line['amount']);
		            $con->execute();

		            if ($con->affected_rows < 0) {
		            	?>
			                <div class="alert alert-danger" role="alert">Producto <?=$linea['product']?> NO insertado en la venta</div>
			            <?php	
		            }

		            //Actualiza el stock de producto
		            $query2 = 'UPDATE productos SET cantidad = cantidad - "'.$line['amount'].'"  WHERE productoID = "'.$line['code'].'" ';
		            $stmt = $db->prepare($query2);
            		$stmt->execute();

            		if ($stmt->affected_rows < 0) {
		            	?>
			                <div class="alert alert-danger" role="alert">Producto <?=$linea['product']?> NO actualizado en inventario</div>
			            <?php	
			            
			            
			    	}else{

			    		//Si la venta se hizo correctamente vacia el carro de compra 
			            $carrito = new Cart();
			           	$carrito -> empty_cart();
			           	
			           	//Vacia tambien el carro guardado de mesa si la venta correspondia a una de ellas
			           	if(isset($_SESSION['current'])){
			           		//Recupera de que mesa era el carro
			           		$mesa = $_SESSION['current'];
			           		//Borra el carro guardado de esa mesa y lo quita del carro actual
			    			unset($_SESSION[$mesa]);
			    			unset($_SESSION['current']);

			    		}
			           
			        }

				}
			}
        	$db->close();

        	?>
        	
        	<?php
		}


}

$sesion = new Sesion();
$sesion -> sesion();
$sesion -> comprobar();	


$cobro = new Cobro();
$cobro -> display();

$cobro -> crearVenta();
$cobro -> imprimirTicket();

