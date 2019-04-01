<?php
//Contiene la conexion a la base de datos   
    class Database{

    	protected $db;

    	public function conectar(){

		 	$db = new mysqli("localhost", "admin", "admin123", "pdv");
			//Comprobar conexion
			if(mysqli_connect_errno())
			{
			
				?>
                  <div class="alert alert-danger" role="alert">Falló la conexión</div>
                  <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo ROOT_PATH."login.php"; ?>">
            	<?php
				
			}
			else {
				
				return $db;

    		}

    	}

   
	}
	

?>