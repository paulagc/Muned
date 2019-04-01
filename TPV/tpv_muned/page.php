<?php
//Plantilla basica de pagina

//Incluye el archivo con rutas absolutas a las carpetas del proyecto
require_once(__DIR__.'/dirs.php');
require_once(__DIR__.'/fpdf/fpdf.php');



class Page{
	//Atributos clase page
	public $content;
	public $title = "TPV Muned";
	public $keywords = "TPV, comercio, prototipo";


	//Muestra las secciones html
	public function display(){

		$this -> displayTitle();
		$this -> displayKeywords();
		$this -> displayHeader();
		
		?>
		<div class="container-fluid">
		<?php
		echo $this -> content;

		?>
		</div>
		<?php
	}

	//Crea el title, agrega estilos
	public function displayTitle(){
		echo "<html>\n<head>\n";

		?>
		
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<link href="<?php echo CSS_PATH."bootstrap.min.css"; ?>" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH."styles.css"; ?>">
		<link href="<?php echo CSS_PATH."all.css"; ?>" rel="stylesheet">
		<?php
		echo "<title>".$this -> title."</title>";
	}

	//Muestra las keywords de pagina
	public function displayKeywords(){
		echo "<meta name = 'keywords' content = '" .$this -> keywords."'/>";
	}

	public function displayStyles(){
		//aqui va link a hoja de estilos css
	}

	//Crea el header y agrega estilos
	public function displayHeader(){
		echo "</head>\n<body>\n";
		?>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="<?php echo JS_PATH."bootstrap.min.js"; ?>"></script>
		<script type="text/javascript" src="<?php echo JS_PATH."funciones.js"; ?>"></script>
		<script type="text/javascript" src="<?php echo JS_PATH."table.js"; ?>"></script>
		<script type="text/javascript" src="<?php echo JS_PATH."jspdf.min.js"; ?>"></script>
		<script type="text/javascript" src="<?php echo JS_PATH."from_html.js"; ?>"></script>
		<script type="text/javascript" src="<?php echo JS_PATH."split_text_to_size.js"; ?>"></script>
		<script type="text/javascript" src="<?php echo JS_PATH."standard_fonts_metrics.js"; ?>"></script>
		<script type="text/javascript" src="<?php echo JS_PATH."html2canvas.js"; ?>"></script>
		
		
		<?php
	}



	public function displayMenu($buttons){

		?>
		<div id="centrar">
		<div id="menutop">
		    
		    
		    <!--Menu que solo se muestra para dispositivo movil-->
		    <nav class="menumovil">
		        <ul>
		            
					<li><a href="<?= ROOT_PATH."ventas.php" ?>"><button type= "button" class= "boton"><?= Venta ?></button></a></li>
					<li><a href="<?= ROOT_PATH."logout.php" ?>"><button type= "button" class= "boton"><?= "Cambiar usuario" ?></button></a></li>

		            
		        </ul>
		        
		    </nav>
			
			<!--Menu que se muestra en el monitor principal-->
			<nav class="menutop">
			<ul>
				<?php
				while (list($name, $url) = each($buttons)){
					
					//Si es un array quiere decir que sera un menu desplegable con submenu
					if(is_array($url)){
						
						?>
						<li><a href=""><?= $name ?></a>
							<ul>	

						<?php

						while (list($name2, $url2)= each($url)) {
								?>
								<li><a href="<?= $url2 ?>"><?= $name2 ?></a></li>

								<?php
						}

						?>
							</ul>
						</li>
						<?php

					}else{
						
						?>
						<li><a href="<?= $url ?>"><?= $name ?></a></li>

						<?php
					}

				}

				?>
			</ul>
			</nav>
		</div>
		<?php
	}

	//Devuelve si es la pagina actual o no
	public function isURLCurrentPage($url){
		if(strpos($_SERVER['PHP_SELF'], $url) == false){
			return false;
		}else{
			return true;
		}
	}

	//Muestra los botones en dos estilos segun esten activos o desactivados
	public function displayButton($name, $url, $active = true){
		
		if($active){
			?>
			
       		 <a class="btn btn-primary" href="<?=$url?>" role="button">
       			 <span class="menutext"><?=$name?></span>
        	</a>
      	<?php
		}else{
			?>
			<button class="btn btn-secondary" type="submit"><?=$name?></button>
			<?php
		}
	}

	//Muestra el footer
	public function displayFooter(){
		?>
		
		<footer>
			<div class="foot">
				<p>TPV Muned 2018<br /></p>
			</div>
		</footer>
		<?php
		//div que centra todo 
		echo "</div>\n";
		echo "</body>\n</html>\n";
	}

}

?>