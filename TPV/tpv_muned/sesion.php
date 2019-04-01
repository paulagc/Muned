<?php
//Inicia sesion de usuario
require_once(__DIR__.'/dirs.php');

class Sesion{

	//Inicia sesion en cada pagina del site
	public function sesion(){
		
		session_start();
	}

	//Comprueba que se haya iniciado sesion, en caso contrario envia al apartado para iniciarla
	public function comprobar(){

		//si no hay sesion iniciada en alguno de los dos redirige al login
		if(!(isset($_SESSION['gerente'])|| isset($_SESSION['camarero']))){
			?>
	           <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=<?php echo ROOT_PATH."login.php"; ?>"> 
	        <?php

		}

		
	}


}




?>