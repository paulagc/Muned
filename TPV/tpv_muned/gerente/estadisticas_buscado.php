<?php
//Muestra las ventas por fechas

    require_once ("plantilla_gerente.php");
    require_once ("../database.php");

    class Statistics_Searched extends PlantillaGerente{
      

      public function displayBody(){
        ?>
        <div class="contenido">

        <?php

        //Guarda las variables de rango de fechas
        $desde=$_POST['desde'];
        $hasta=$_POST['hasta'];

        if (!$desde || !$hasta) {
           ?>
              <div class="alert alert-danger" role="alert">No se han introducido los datos necesarios</div>
              <META HTTP-EQUIV="REFRESH" CONTENT="3;URL=<?php echo GERENTE_PATH."estadisticas_buscar.php"; ?>">
            <?php
           exit;
        }

        //Conexion a la base de datos
        $conexion = new Database();
        $db = $conexion ->conectar();

        //Consulta las ventas en ese rango de fecha
        $query = "SELECT ventas.ventaID, ventas.empleado, ventas.total, ventas.fecha, productos.nombre, linea_venta.cantidad, linea_venta.precio, linea_venta.cantidad* linea_venta.precio AS subtotal  FROM ventas JOIN linea_venta ON ventas.ventaID = linea_venta.ventaID JOIN productos ON linea_venta.productoID = productos.productoID WHERE fecha BETWEEN '".$desde."' AND '".$hasta."' ";

        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
  
        $stmt->bind_result($ventaID, $empleado, $total, $fecha, $producto, $cantidad, $precio, $subtotal);

        //Recupera la primera linea
         $stmt-> fetch();
         //Recupera el primer ID de ticket
         $venta = $ventaID;

         //Lineas de resultados de la consulta
         $resultados = $stmt->num_rows;
         ?>
         <h3>Ventas encontradas: <?= $stmt->num_rows ?></h3>
          <?php
         //Mientras queden lineas por imprimir
         while ($resultados != 0){
          ?>
          
          <table class="table table-striped">
                  <thead>
                    <tr class="bg-dark text-white">
                      <th>ID Venta: <?=$ventaID?> </th>
                      <th>Empleado: <?=$empleado?> </th>
                      <th>Fecha: <?=$fecha?> </th>
                      <th>Total: <?=number_format($total,2,',','.') ?> €</th>
                    <tr>
                      <th scope= "col">Producto</th>
                      <th scope= "col">Cantidad</th>
                      <th scope= "col">Precio</th>
                      <th scope= "col">Total</th>

                  </tr>

                </thead>
                 <tbody>
          <?php
          //Mientras haya lineas por imprimir comprueba que las lineas de venta sean del mismo ID, sino cambia de ticket
          while(($resultados > 0) && ($ventaID == $venta)){
            
            //Quita lineas del total de consultas
            $resultados --;
            ?>
              <tr>
                <td><?=$producto?></td>
                <td><?=$cantidad?></td>
                <td><?=number_format($precio,2,',','.')?> €</td>
                <td><?php echo number_format($subtotal,2,',','.')?> €</td>
              </tr>
             <?php
             //Recupera otra linea de resultados
             $stmt-> fetch();
          }
          //Iguala ID con el nuevo ticket
          $venta = $ventaID;

          ?>
               </tbody>
          
            </table>
            <br>
          <?php

         }

            ?>
                  
        </div>
      <?php
    }
  }

  $stats = new Statistics_Searched();


  $stats -> display();
  $stats -> displayBody();
  $stats -> displayFooter();


  ?>



