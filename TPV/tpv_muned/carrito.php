<?php
//Muestra el carrito actualizado en tiempo real
require_once("catalogo.php");

class Cart extends Catalogue{

	public $cart = array();

	//Constructor de sesion carrito
    public function __construct(){ 
    	parent::__construct(); 
    	if(isset($_SESSION['cart'])){
    		$this->cart = $_SESSION['cart'];
    	}
    }

    	//Agrega productos al carro mediante su codigo y cantidad a comprar
	    public function add_item($code, $amount){

	    	//Si agrega un producto con cantidad mayor que 0
	    	if($amount > 0){

		    	//Busca el producto en el catalogo y recupera sus atributos
				$search = $this->search_code($code);
				$code = $this->code;
				$category = $this->category;
				$product = $this->product;
				$price = $this->price;
				$iva = $this->iva;

				//El producto a agregar se introduce en un array
				$item = array('code' => $code, 'product' => $product, 'category' => $category, 'price' => $price, 'iva' => $iva, 'amount' => $amount);
				
				//Si ya hay cosas en el carrito
				if(!empty($this->cart)){
					foreach ($this->cart as $linea){
						//Si el articulo que agrega ya existe actualiza su cantidad
						if($linea['code'] == $code){
							//Si al sumarlo se pasa del maximo stock de producto da un aviso
							if( ($linea['amount'] + $item['amount']) > $this->stock){
								?>

							        <script language="javascript"> 
							        	function noStock()
									    { 
									        alert("No hay más stock del producto");
									    } 
							             
							            noStock(); 
							        </script> 
							 

					                

					            <?php
								$item['amount'] = $linea['amount'];
							}else{
								$item['amount'] = $linea['amount'] + $item['amount'];
							}
							
						}
					}
				}
				//Actualiza el subtotal de ese articulo, su precio por la cantidad que haya
				$item['subtotal'] = round (($item['price'] * $item['amount']), 2);
				$id = md5($code);
				//Lo agrega a la sesion con su id
				$_SESSION['cart'][$id] = $item;

	    	}
	    	//Actualiza el carro para que refleje el ultimo cambio
			$this->update_cart();
		
		}

		//Borra un producto del carro
		public function remove_item($code){
			$id = md5($code);
			unset($_SESSION['cart'][$id]);
			//Actualiza el carro con el ultimo cambio
			$this->update_cart();
			return true;
		}

		//Obtiene los productos y los muestra
	    public function get_items(){
	    	//Si no esta vacio empieza a imprimirlos
	    	if(!empty($this->cart)){
	    		
		    	foreach ($this->cart as $linea) {
		    		
		    		?>
			          <tr class="filaTicket">
				            <td height="20"><?=$linea['code']?></td>
				            <td><?=$linea['product']?></td>
				            <td align="right"><?php echo number_format($linea['price'], 2, ',','.')?></td>
				            <td align="right"><?=$linea['iva']?></td>
				            <td align="right"><?= $linea['amount']?></td>
				            <td align="right"><?php echo number_format($linea['subtotal'], 2, ',','.') ?></td>

				             
				            <td>
				              <button onClick="borrarProducto(<?=$linea['code']?>);">Borrar</button>

				           </td>

			           </tr>
		 			<?php

	    	}

	    	}
	    	
	    }

	    //Obtiene el total de productos en el carro
	    public function get_total_items(){
	    	$total = 0;
	    	//Si no esta vacio va sumando la cantidad de articulos
	    	if(!empty($this->cart)){
	    		foreach ($this->cart as $linea){
					$total += $linea['amount'];
				}
	    	}
	    	echo $total;
	    }

	    //Obtiene el importe total del carro
	    public function get_total_payment(){
	    	$total = 0;
	    	//Si no esta vacio va sumando el importe
	    	if(!empty($this->cart)){
	    		foreach ($this->cart as $linea){
					$total += $linea['subtotal'];
				}
	    	}

	    	$_SESSION['importe'] = $total;

	    	return number_format($total, 2,',','.');
	    }

	    //Actualiza el carro mediante el constructor
		public function update_cart(){
			self::__construct();
		}

		//Vacia el carro completo cerrando la sesion
		public function empty_cart(){
			
			if(isset($_SESSION['cart'])){
    			unset($_SESSION['cart']);
    		}

    		$this->update_cart();

		}

		//Carga la comanda de la mesa indicada
		public function load_cart($table){
			$this ->empty_cart();
			//Recupera numero de mesa
			$mesa = "table".$table;
			//Asigna lo guardado en esa mesa al carro actual
			$_SESSION['cart'] = $_SESSION[$mesa];

			//Actualiza la informacion de que el carrito actual pertenece a esa mesa
			$_SESSION['current'] = $mesa;

			//Actualiza el carro para mostrar cambios
    		$this->update_cart();

		}

		//Guarda los cambios del carrito en la mesa actual
		public function save_cart($table){
			//Asigna el carrito a la mesa correspondiente
			$_SESSION[$table] = $_SESSION['cart'];

		}

		//Hace que el carrito actual no pertenezca a ninguna mesa
		public function none(){
			
			if(isset($_SESSION['current'])){
    			unset($_SESSION['current']);
    		}

		}


}



?>