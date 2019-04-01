<?php
//Plantilla para las paginas dentro del rol gerente

require_once("../sesion.php");
require_once ("../page.php");
require_once ("../menus.php");

class PlantillaGerente extends Page{

	public function menu(){
		$menus = new Menus();
    	$buttons_gerente = $menus ->gerente();
    	$this -> displayMenu($buttons_gerente);

	}

}
	//Inicia sesion
	$sesion = new Sesion();
  	$sesion -> sesion();
  	$sesion -> comprobar();	
  	
     
	$plantilla = new PlantillaGerente();
	$plantilla -> menu();
	
	$plantilla -> display();

?>