<?php
//Muestra el catalogo de productos a la venta para seleccionarlos
require_once("database.php");

class Catalogue{
	public $code;
	public $product;
    public $category;
	public $price;
    public $iva;
	public $stock;

    public $bebidas = array();
    public $comidas = array();
    

	 public function __construct(){

	 }


     //Obtiene las subcategorias de bebidas o comidas
     public function get_categories($tipo){

        $conexion = new Database();
        $db = $conexion ->conectar();

        $query = 'SELECT nombre, imagen FROM categorias WHERE tipo = "'.$tipo.'"';
        $stmt = $db->prepare($query);  
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($nombre, $imagen);

        
        if($tipo == "bebida"){

            //Introduce los resultados en un array de categorias
            while($stmt->fetch()) {
                //Cada categoria es un array de nombre e imagen
                $categoria = array($nombre, $imagen);

                array_push($this->bebidas, $categoria);


                
            }


        }elseif($tipo == "comida") {
            
            //Introduce los resultados en un array de categorias
            while($stmt->fetch()) {
                //Cada categoria es un array de nombre e imagen
                $categoria = array($nombre, $imagen);

                array_push($this->comidas, $categoria);
                
                
            }


        }

        //Copia las categorias en la sesion
        $_SESSION['bebidas'] = $this->bebidas;
        $_SESSION['comidas'] = $this->comidas;
        

     }



    public function show_categories($tipo){

        //Si es la primera vez que se muestran las categorias el bebidas_ult se pone a -1
        if(!isset($_SESSION['bebida_ult'])){
            $_SESSION['bebida_ult'] = -1;
        //Si se llego al maximo vuelve a empezar
        }elseif (!isset($_SESSION['comida_ult'])) {
            $_SESSION['comida_ult'] = -1;
        }

        //Divide segun el tipo de categoria
        if($tipo == "bebida"){

            //Si el numero de categorias es menor que 9, el maximo es el numero de categorias
            if(count($this->bebidas) < 7){
                $maximo = count($this->bebidas);
            }else{
                $maximo = 7;
            }

            //Muestra de 8 en 8
            for ($i = 0; $i < $maximo ; $i++) { 

                
                //Desde la siguiente categoria 
                $nombre = $this->bebidas[$i][0];
                $imagen = $this->bebidas[$i][1];
                //echo $nombre;
                ?>
                    <li id="li">
                        
                        <div class="catimg">
                            <a class="categoria" href='ventas.php?action=menu&category=<?=$nombre?>'>
                                
                                    <img class= "fondocat" src="<?=UPLOADS_ROOT_PATH.$imagen?>" alt="" width="120px" height="80px">
                                    <div class="nombrecat">
                                        <?= $nombre ?>
                                    </div>
                                
                            </a>
                        </div>
                    </li>
                <?php

                //La ultima categoria será la ultima mostrada
                $_SESSION['bebida_ult'] = $i;
            }
           

        }elseif ($tipo == "comida") {

            //Si el numero de categorias es menor que 9, el maximo es el numero de categorias
            if(count($this->comidas) < 7){
                $maximo = count($this->comidas);
            }else{
                $maximo = 7;
            }
            
            //Muestra de 7 en 7
            for ($i = 0; $i < $maximo ; $i++) { 

                 //Si se pasa del numero de categorias reinicia la cuenta
                if($_SESSION['comida_ult'] + 1 >= count($this->comidas) ){
                    $_SESSION['comida_ult'] = -1;
                }
                
                //Desde la siguiente categoria 
                $nombre = $this->comidas[$i][0];
                $imagen = $this->comidas[$i][1];
               
                ?>
                    <li id="li">
                        
                        <div class="catimg">
                            <a class="categoria" href='ventas.php?action=menu&category=<?=$nombre?>'>
                                
                                    <img class= "fondocat" src="<?=UPLOADS_ROOT_PATH.$imagen?>" alt="" width="120px" height="80px">
                                    <div class="nombrecat">
                                        <?= $nombre ?>
                                    </div>
                                
                            </a>
                        </div>
                    </li>
                <?php

                //La ultima categoria será la ultima mostrada
                $_SESSION['comida_ult'] = $i;
            }
            
        }
        
    }


    public function more_categories($tipo){

       
       $bebidas = $_SESSION['bebidas'] ;
       $comidas = $_SESSION['comidas'] ;

        //Si es la primera vez que se muestran las categorias el bebidas_ult se pone a -1
        if(!isset($_SESSION['bebida_ult'])){
            $_SESSION['bebida_ult'] = -1;
        //Si se llego al maximo vuelve a empezar
        }elseif (!isset($_SESSION['comida_ult'])) {
            $_SESSION['comida_ult'] = -1;
        }
        
        //Divide segun el tipo de categoria
        if($tipo == "bebida"){

            //Si el numero de categorias es menor que 7, el maximo es el numero de categorias
            if(count($bebidas) < 7){
                $maximo = count($bebidas);
            }else{
                $maximo = 7;
            }

            //Muestra de 7 en 7
            for ($i = 0; $i < $maximo ; $i++) { 
                
                 //Si se pasa del numero de categorias reinicia la cuenta
                if($_SESSION['bebida_ult'] + 1 >= count($bebidas) ){
                    $_SESSION['bebida_ult'] = -1;
                }
                
                //Desde la siguiente categoria 
                $nombre = $bebidas[$_SESSION['bebida_ult'] + 1][0];
                $imagen = $bebidas[$_SESSION['bebida_ult'] + 1][1];
                
                ?>
                    <li id="li">
                        
                        <div class="catimg">
                            <a class="categoria" href='ventas.php?action=menu&category=<?=$nombre?>'>
                                
                                    <img class= "fondocat" src="<?=UPLOADS_ROOT_PATH.$imagen?>" alt="" width="120px" height="80px">
                                    <div class="nombrecat">
                                        <?= $nombre ?>
                                    </div>
                                
                            </a>
                        </div>
                    </li>
                <?php

                $_SESSION['bebida_ult'] = $_SESSION['bebida_ult'] + 1;

                //Si se pasa del numero de categorias reinicia la cuenta
                if($_SESSION['bebida_ult'] >= count($bebidas) ){
                    $_SESSION['bebida_ult'] = -1;
                }
            }
           

        }elseif ($tipo == "comida") {

            //Si el numero de categorias es menor que 7, el maximo es el numero de categorias
            if(count($this->comidas) < 7){
                $maximo = count($this->comidas);
            }else{
                $maximo = 7;
            }
            
            //Muestra de 7 en 7
            for ($i = 0; $i < $maximo ; $i++) { 

                 //Si se pasa del numero de categorias reinicia la cuenta
                if($_SESSION['comida_ult'] + 1 >= count($this->comidas) ){
                    $_SESSION['comida_ult'] = -1;
                }
                
                //Desde la siguiente categoria 
                $nombre = $this->comidas[$_SESSION['comida_ult'] + 1][0];
                $imagen = $this->comidas[$_SESSION['comida_ult'] + 1][1];
                //echo $nombre;
                ?>
                    <li id="li">
                        
                        <div class="catimg">
                            <a class="categoria" href='ventas.php?action=menu&category=<?=$nombre?>'>
                                
                                    <img class= "fondocat" src="<?=UPLOADS_ROOT_PATH.$imagen?>" alt="" width="120px" height="80px">
                                    <div class="nombrecat">
                                        <?= $nombre ?>
                                    </div>
                                
                            </a>
                        </div>
                    </li>
                <?php

                $_SESSION['comida_ult'] = $_SESSION['comida_ult'] + 1;

                //Si se pasa del numero de categorias reinicia la cuenta
                if($_SESSION['comida_ult'] >= count($this->comidas) ){
                    $_SESSION['comida_ult'] = -1;
                }
            }
            
        }
        

    }
	
    //Obtiene los productos de la base de datos
	public function get_products(){ 

		
		$conexion = new Database();
        $db = $conexion ->conectar();

        //Categoria seleccionada en el panel
        $categoria = $_SESSION['category'];

        //Selecciona los atributos de los productos y obtiene el nombre de categoria
		$query = "SELECT productos.productoID, categorias.nombre, productos.nombre, productos.precio, productos.cantidad, productos.imagen  FROM productos JOIN categorias ON productos.categoriaID = categorias.categoriaID WHERE categorias.nombre = '".$categoria."'";
	
        $stmt = $db->prepare($query);  
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($id, $categoria, $nombre, $precio, $cantidad, $imagen);
   

        //Imprime los productos del catalogo
        while($stmt->fetch()) {

            ?>
                <li id="li">

                    <div class="catimg">
                        
                        <a class="categoria" 
                        <?php
                        //Si no hay stock se pone en rojo (null es infinito)
                        
                        if((is_null($cantidad)) || ($cantidad > 1)){
                            ?>
                                href='ventas.php?action=add&code=<?=$id?>&amount=1'>
                                
                            <?php
                        }else{
                            ?>
                                id= "sinstock" href="javascript:void(0)" >
                            <?php
                        }
                        ?>

                            <img class= "fondocat" src="<?=UPLOADS_ROOT_PATH.$imagen?>" alt="" width="120px" height="80px">
                            <div class="nombrecat"
                            <?php
                            if((is_null($cantidad)) || ($cantidad > 1)){
                                ?>
                                    >
                                <?php
                            }else{
                                ?>
                                    id= "sinstock" >
                                <?php
                                
                            }
                            ?>
                                <?= $nombre ?>
                            </div>
                        </a>
                    </div>

                </li>

            <?php



        }
        /*
        //Si hay menos de 4 productos imprime espacios para ajustar la ventana
        if($stmt->num_rows < 4){

            $espacios = 4 - $stmt->num_rows;
            while($espacios != 0){

                ?>
                <div class="col-md-3">
                   <button type= "button" class= "btn my-1 w-100"></button>
                </div>
            <?php

                $espacios = $espacios -1;
            }
        }*/

        $stmt->free_result();
        $db->close();



   	} 

    //Obtiene los atributos de producto a traves de su codigo
   	public function search_code($code){
    	

    	$conexion = new Database();
    	$db = $conexion ->conectar();

    	$query = "SELECT productoID, categoriaID, nombre, precio, iva, cantidad FROM productos WHERE productoID = ?";
		$stmt = $db->prepare($query);
        $stmt->bind_param('s', $code);  
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $categoriaID, $nombre, $precio, $iva, $cantidad);

        //Este bucle solo se recorrera una vez, solo hay un producto con cada id
        while($stmt->fetch()) {
        	//Rellenar atributos de clase con el producto recuperado
        	$this->code = $id;
			$this->product = $nombre;
            $this->category = $categoriaID;
			$this->price = $precio;
            $this->iva = $iva;
			$this->stock = $cantidad;

        }
        
		$stmt->free_result();
        $db->close();
 
 	}

}


?>