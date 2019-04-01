<?php
//Pagina principal del rol de gerente

require_once ("plantilla_gerente.php");
require_once ("../database.php");


class Admin extends PlantillaGerente{

	 public function displayBody(){
        ?>
        <div class="contenido  texto">
        	<div id="logo" class="logo">
          		<img src="<?=CSS_PATH."logo.png"?>" alt="" >
        		<h2>Bienvenido <?= $_SESSION['gerente'] ?></h2>
        	</div>
        
        
        <?php

    }
    
    //Muestra avisos de productos sin stock
    public function displayStock(){
        
        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();
       
        //Muestra los productos y recupera el nombre de la categoria
        $query = "SELECT productoID, nombre FROM productos WHERE cantidad = 0";
        $stmt = $db->prepare($query); 
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $nombre);
        
        ?>
        <div class= "stock">
            <h3>Productos sin stock: <?= $stmt->num_rows?></h3>
            <?php
            while($stmt->fetch()) {
                ?>
                <div class="alert alert-danger" role="alert">ID <?=$id?> -  <?=$nombre?></div>
                <?php
            }
            ?>
            
            
        </div>

        </div>
        <?php
    
    }
}
	
	$gerente = new Admin();


	$gerente -> display();
	$gerente -> displayBody();
	$gerente -> displayStock();
	$gerente -> displayFooter();

?>