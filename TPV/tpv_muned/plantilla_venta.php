<?php
//Plantilla con la estructura de la pagina de ventas

require_once("sesion.php");
require_once ("page.php");
require_once ("menus.php");

class PlantillaVenta extends Page{


	//Elige botones segun tipo de usuario
	public function logged(){
		
        $menus = new Menus();
        $buttons_gerente = $menus ->gerente();
        $buttons_camarero = $menus ->camarero();


		if (isset($_SESSION['gerente']))  {

      		$this -> displayMenu($buttons_gerente);

  		} else if (isset($_SESSION['camarero'])){

  			$this -> displayMenu($buttons_camarero);

		}else{

			echo "Error, no hay usuario logueado";
		}
	}
	

}

	$sesion = new Sesion();
  	$sesion -> sesion();
  	$sesion -> comprobar();	


	
	$plantilla = new PlantillaVenta();

	//Comprobar quien esta haciendo la venta y mostrar el menu apropiado
	$plantilla -> logged();
	$plantilla -> display();
	

?>