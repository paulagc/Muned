<?php


	class Menus{

		public $buttons_inventario = array( "Buscar" => GERENTE_PATH."inventario_buscar.php", "Agregar" => GERENTE_PATH."inventario_agregar.php", "Ver" => GERENTE_PATH."inventario_ver.php");

		public $buttons_categorias = array( "Buscar" => GERENTE_PATH."categorias_buscar.php", "Agregar" => GERENTE_PATH."categorias_agregar.php", "Ver" => GERENTE_PATH."categorias_ver.php");

		public $buttons_empleados = array("Buscar" => GERENTE_PATH."empleados_buscar.php", "Agregar" => GERENTE_PATH."empleados_agregar.php", "Ver" => GERENTE_PATH."empleados_ver.php");
		
		public $buttons_estadisticas_gerente = array("Resumen" => GERENTE_PATH."estadisticas_resumen.php", "Buscar" => GERENTE_PATH."estadisticas_buscar.php");

		public $buttons_estadisticas_camarero = array("Resumen" => CAMARERO_PATH."estadisticas_resumen.php", "Buscar" => CAMARERO_PATH."estadisticas_buscar.php");
	

		public function gerente(){
			$buttons_gerente = array("Home" => GERENTE_PATH."home_gerente.php", "Categorias" => $this->buttons_categorias, "Productos" => $this->buttons_inventario, "Empleados" => $this->buttons_empleados, "Estadisticas" => $this->buttons_estadisticas_gerente, "Venta" => ROOT_PATH."ventas.php", "Cambiar usuario" => ROOT_PATH."logout.php");
			return $buttons_gerente;

		}

		public function camarero(){
			$buttons_camarero = array("Home" => CAMARERO_PATH."home_camarero.php", "Estadisticas" => $this->buttons_estadisticas_camarero, "Venta" => ROOT_PATH."ventas.php", "Cambiar usuario" => ROOT_PATH."logout.php");
			return $buttons_camarero;
		}

	}

?>