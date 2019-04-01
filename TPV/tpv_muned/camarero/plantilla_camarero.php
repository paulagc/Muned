<?php
//Plantilla para las paginas del rol camarero

require_once("../sesion.php");
require_once ("../page.php");
require_once ("../menus.php");

class PlantillaCamarero extends Page{

	public function menu(){
		$menus = new Menus();
    	$buttons_camarero = $menus ->camarero();
    	$this -> displayMenu($buttons_camarero);

	}
	


}
	$sesion = new Sesion();
  	$sesion -> sesion();
  	$sesion -> comprobar();	
	
	$plantilla = new PlantillaCamarero();
	$plantilla -> menu();
	
	$plantilla -> display();

?>