<?php
	
		$SID= session_id(); 
		$id_cliente = clear($_SESSION['id_cliente']);
		$sc = $mysqli->query("SELECT * FROM compra WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1");
		$rc = mysqli_fetch_array($sc);
		$total = $rc['monto'];
?>

<div class="jumbotron text-center" >
	<h1 class="display-4">¡Paso final !</h1>
	<hr class="my-4">
	<p class="lead">Estas a punto de pagar con Paypal la cantidad de:</p>
	<h4>$<?php echo number_format($total,2)?></h4>
	<div id="paypal-button-container"></div>
	<p>Los productos se enviaran una vez se procese el pago</p>
	<strong>(Dudas o aclaraciones :anaquelesMeGar@hotmail.com)</strong>
	
	

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AZxsA-jGk6Q6s7eki2EGwcjn4NcPdG_LfTTIVWGCyH4DW_3ta6n96Ctvj3vHhP6FYi3Px673bMHCMB_x&currency=MXN"></script>

<script>
	// Render the PayPal button into #paypal-button-container
	paypal.Buttons({

		// Set up the transaction
		createOrder: function(data, actions) {
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: '<?php echo $total?>',
						description:"Compra de productos $:<?php echo number_format($total,2);?>",
						custom:"<?php echo $SID;?>"
					}
				}]
			});
		},

		// Finalize the transaction
		onApprove: function(data, actions) {
			return actions.order.capture().then(function(details) {
				console.log(data);
				
				window.location="?p=verificador&id="+data.orderID+"&payerID="+data.payerID;

			});
		}


	}).render('#paypal-button-container');
</script>