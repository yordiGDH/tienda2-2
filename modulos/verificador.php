<?php
    $Order= $_GET['id'];
    $IDPAGO=$_GET['payerID'];
	$SID= session_id(); 
    $id_cliente = clear($_SESSION['id_cliente']);
    $estado = 1;
    
    $sc = $mysqli->query("SELECT * FROM compra WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1");
    $rc = mysqli_fetch_array($sc);
    $total = $rc['monto'];
    $idcompra = $rc['id'];
    $fecha = $rc['fecha'];

    $s = $mysqli->query("SELECT * FROM clientes WHERE id = '".$rc['id_cliente']."'");
    $r = mysqli_fetch_array($s);
    $nombre = $r['username'];




    $sentencia = $mysqli->query("INSERT INTO pagos (id, id_cliente, id_compra, comprobante, nombre, fecha, estado, id_venta) 
        VALUES ('$idcompra', '$id_cliente', '$idcompra', '$Order', '$nombre', '$fecha', '$estado', '$IDPAGO')");
        
    $sent = $mysqli->query("UPDATE compra SET estado = '1' WHERE id='$idcompra';");



?>

<h1>FELICIADES SE HA REALIZADO CON EXITO TU COMPRA. #<?php echo $Order?></h1>

<H3>Hola <?php echo $nombre?>, tu compra  con valor $<?php echo number_format($total,2)?> se ha realizado con éxito,enviaremos los producto en el domicilio que proporcionaste <br>
GRACIAS POR TU COMPRA.
  </H3>


  <?php echo $Order ?> <br>
  <?php echo $IDPAGO ?> <br>
Fecha: <?=fecha($rc['fecha'])?><br>
Monto: <?=number_format($rc['monto'])?> <?=$divisa?><br>
Estado de envio: <?=estado($rc['estado'])?><br>
