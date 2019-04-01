<?php

//Estructura que contiene el catalogo y carrito de compras para efectuar las ventas

require_once("sesion.php");
require_once("plantilla_venta.php");
require_once('catalogo.php');
require_once('carrito.php');


class Ventas extends PlantillaVenta{

	
	//Actualiza la sesion de carrito agregando, quitando o vaciandola de productos
	public function recargar(){
		$cart = new Cart();
		$catalogue = new Catalogue();

		//Guarda los cambios del carro en la mesa actual
		if(isset($_SESSION['current'])){
			$cart->save_cart($_SESSION['current']);
		}
		
		
		if(isset($_GET['action'])){
			switch ($_GET['action']){
				case 'add':
					$cart->add_item($_GET['code'], $_GET['amount']);
				break;
				case 'remove':
					$cart->remove_item($_GET['code']);
				break;
				case 'empty':
					$cart->empty_cart();
				break;
				case 'load':
					$cart->load_cart($_GET['table']);
				break;
				case 'save':
					$cart->save_cart($_GET['table']);
				break;
				case 'menu':
					$_SESSION['category'] = $_GET['category'];
				break;
				case 'none':
					$cart -> none();
				break;


			}	
		}
	}

	//Cuerpo de la pagina con catalogo y carro
	public function displayBody(){


?>
	

	<div id= "ventasFondo" class="contenido">

	
	<div id="lateral">

			<div id= "titulo">
				<h4>MESAS</h4>
				
			</div>
		    <div id= mesas>
		        <nav class= "navmesa">
		            <ul class="ulmesa">
		                <li>
            			<a class="table" href='ventas.php?action=none'><button type= "button" class= "boton mesa">Ninguna</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=1'><button type= "button" class= "boton mesa">1</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=2'><button type= "button" class= "boton mesa">2</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=3'><button type= "button" class= "boton mesa" >3</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=4'><button type= "button" class= "boton mesa">4</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=5'><button type= "button" class= "boton mesa">5</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=6'><button type= "button" class= "boton mesa">6</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=7'><button type= "button" class= "boton mesa">7</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=8'><button type= "button" class= "boton mesa">8</button></a></li>
            			<li>
            			<a class="table" href='ventas.php?action=load&table=9'><button type= "button" class= "boton mesa">9</button></a></li>
            			
        			    </ul>
        			</nav>
		    </div>
	</div>
	<div id="ticket">
		<div id= "encabezado">
			<div>
				<h5 id="pago">Total a pagar: 
				<?php
				//obtiene el total de importe y productos del carro
				$cart = new Cart();
				//$cart->get_total_payment();
				$pago = $cart->get_total_payment();
				echo $pago;

				//Cambia el formato a numero ingles para hacer calculos 
				//$pago = number_format($pago, 4,'.',',')
				?>
					
				</h5>
				<h5 id="items"> Total items: 
					<?php $cart->get_total_items();?>			
				</h5>
				
			</div>
			<div>
				<h5 id="pago">Mesa: 
				<?php
					//Recupera el numero de mesa
					if(isset($_SESSION['current'])){
						$mesa = explode("table", $_SESSION['current']);
						echo $mesa[1]; 
					}
				?>
					
				</h5>
				<h5 id="items"> Camarero: 
					<?php 
						//Imprime el nombre del empleado utilizando el tpv
						if(isset($_SESSION['camarero'])){
							echo $_SESSION['camarero'];
						}elseif (isset($_SESSION['gerente'])) {
							echo $_SESSION['gerente'];
						}
						
					?>			
				</h5>
				
			</div>
			
		</div>
		<div id= "descripcion">
			<table id="tablaticket" class="table-responsive table-striped table-sm mb-1">
					<thead>
						<tr class="bg-dark text-white" id="tablaTitulo">
							<th id= "tablaTitulo" scope= "col">ID</th>
							<th scope= "col">Producto</th>
							<th scope= "col">Precio</th>
							<th scope= "col">% IVA</th>
							<th scope= "col">Cantidad</th>
							<th scope= "col">Subtotal</th>
							<th scope= "col">Opcion</th>
						</tr>
					</thead>
					<tbody>
						<?= //Obtiene los productos del carrito
						$cart->get_items();
						?>
					</tbody>
				</table>
			
			
		</div>
		<div id= "botones">
			<nav>
				<ul>
				    <li>
					    <button type="button" class="boton" data-toggle="modal" data-target="#ventanaCobro" onClick="guardarTotal('<?=$_SESSION['importe']?>');">Cobrar</button>
					</li>
					<li>
					    <a href='ventas.php?action=empty'> <button type="button" class="boton">Vaciar</button></a>
					</li>
				</ul>
			</nav>
			
		</div>
		
	</div>
	<div id="menu">
		<div id="bebida">
			<div id= titulo>
				<h4>BEBIDA</h4>
				
				
			</div>
			
			<div id="lista">
				<nav>
					<ul>
						<?php
						$catalogo = new Catalogue();
						$catalogo->get_categories("bebida");

						if(isset($_GET['bebida'])){
							$catalogo -> more_categories("bebida");
						}else{
							//Imprimir categorias bebida 6 columnas
							
							$catalogo->show_categories("bebida");

						}
						
						?>
						<a  href='ventas.php?bebida'><button type="button"  class="mas boton" >+</button></a>
						
					</ul>
				</nav>
				
				
			</div>
			
			
		</div>
		<div id="comida">
			<div id= titulo>
				<h4>COMIDA</h4>
				
				
			</div>
		
			<div id="lista">
				<nav>
					<ul>
						
						<?php
						$catalogo = new Catalogue();
						$catalogo->get_categories("comida");

						if(isset($_GET['comida'])){
							$catalogo -> more_categories("comida");
						}else{
							//Imprimir categorias bebida 6 columnas
							
							$catalogo->show_categories("comida");

						}
						
						?>
						<a href='ventas.php?comida'><button type="button" class="mas boton"  >+</button></a>
						
					</ul>
				</nav>
			
			</div>
			
		</div>
		<div id="productos">
			<div id= titulo>
				<h4>PRODUCTOS</h4>
				
			</div>
			
			<div id="lista">
				<nav>
					<ul>
						<?php
						//Obtiene los productos a la venta
						
						$catalogo->get_products();

						/*if(isset($_GET['productos'])){
							$catalogo -> more_products();
						}else{
							//Imprimir categorias bebida 6 columnas
							
							$catalogo->show_products();

						}*/
						
						?>
						<a  href='ventas.php?productos'><button type="button"  class="mas boton">+</button></a>
					</ul>
				</nav>
			</div>

			
		</div>
		
		
	
    </div>

	</div>

	<!-- Ventana emergente de cobro -->
	<div class="modal fade" id="ventanaCobro" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="tituloModal">CAJA</h4>
	        <button type="button" class="close" data-dismiss="modal">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

			<div class="cambio">
				<h5 class="total">TOTAL: </h5>
				<h5 class="euros"><?= $_SESSION['importe']?> €</h5>
			  	<h5 class="entregado">ENTREGADO: </h5>
				<div class="screenEntreg">0.00€</div>
				<h5 class="vuelta">CAMBIO: </h5>
				<div class="screenDevol">0.00€</div>
			</div>
	      	<div class="calculator">
	      		
				<div class="calc-row">
				  <div class="button">7</div><div class="button">8</div><div class="button">9</div>
				</div>
				  
				<div class="calc-row">
				  <div class="button">4</div><div class="button">5</div><div class="button">6</div>
				</div>
				  
				<div class="calc-row">
				  <div class="button">1</div><div class="button">2</div><div class="button">3</div>
				</div>
				  
				<div class="calc-row">
				  <div class="button">0</div><div class="button decimal">.</div><div class="button">Borrar</div>
				</div>
				<div class="calc-row">
				  <div class="button zero">Cambio</div>
				</div>
	
				 
			</div>
			
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="boton" onClick="devolucion();">Confirmar</button>
	      </div>
	    </div>
	  </div>
	</div>
	


	<?php


	}


}

	$sesion = new Sesion();
  	$sesion -> sesion();
  	$sesion -> comprobar();	


	$ventas = new Ventas();


	$ventas -> recargar();
	

	$ventas -> displayBody();

	$ventas -> displayFooter();

?>