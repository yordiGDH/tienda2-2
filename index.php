<?php
    include "configs/config.php";
    include "configs/funciones.php";

	if (@!$_SESSION['user']) {
		
	}elseif ($_SESSION['rol']==1) {
		header("Location:admin/admin.php");
    }
    
    if (!isset($p)){
        $p= "principal";
    }
    else{
      $p = $p;   
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="fontawesome/js/all.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <title>Anaqueles García</title>
</head>
<body>
    <div class="contenedor_principal">
        <header>
            <div class="titulo_cabecera">
                <h3>Anaqueles metálicos garcia</h3>        
            </div>
        </header>
        <nav>
            <div class="barra">
                <div class="menu_left">
                    <ul>
                        <li><a href="?p=principal">Inicio</a></li>
                        <li><a href="?p=productos">Productos</a></li>   
                        <li><a href="?p=miscompras">Mis Compras</a></li>
                        <li><a href="?p=carrito">Mi Carrito</a></li>
                    </ul>
                </div>

                <div class="navegacion">
                    <?php
                        if(isset($_SESSION['id_cliente'])){
                    ?>
                        <ul class="menu">
                            <li><a class="" href="#"><?=nombre_cliente($_SESSION['id_cliente'])?></a>
                                    <ul class="submenu">
                                        <li><a href="?p=perfil">ver perfil</a></li>
                                        <li><a class="" href="?p=salir">Salir</a></li>
                                    </ul>
                                </li>
                        </ul>
                    <?php
                    }else{
                        ?>
    
                        <ul>
                            <li><a href="?p=login">Iniciar sesión</a></li>
                            <li><a href="?p=registro">Registrate</a></li>
                        </ul>
                        <?php
                    }
                    ?>            
                </div>    
            </div>
        </nav>
        <!--
        </div> -->
        <section>
            <div class="cuerpo">
                <?php
                    if(file_exists("modulos/".$p.".php")){
                        include"modulos/".$p.".php";
                    }
                    else{
                        echo"<i>No se ha encontrado el modulo <b>".$p."</b><a href='./'> Regresar</a></i>";
                    }
                ?>
            </div>
            <div class="carritot" onclick="minimizer()">
        Carrito de compra
        <input type="hidden" id="minimized" value="0"/>
    </div>

    <div class="carritob">

        <table class="table table-striped">
    <tr>
        <th>Nombre del producto</th>
        <th>Cantidad</th>
        <th>Precio </th>
    </tr>
<?php
$id_cliente = clear($_SESSION['id_cliente']);
$q = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
$monto_total = 0;
while($r = mysqli_fetch_array($q)){
    $q2 = $mysqli->query("SELECT * FROM productos WHERE id = '".$r['id_producto']."'");
    $r2 = mysqli_fetch_array($q2);

    $preciototal = 0;
            if($r2['oferta']>0){
                if(strlen($r2['oferta'])==1){
                    $desc = "0.0".$r2['oferta'];
                }else{
                    $desc = "0.".$r2['oferta'];
                }

                $preciototal = $r2['price'] -($r2['price'] * $desc);
            }else{
                $preciototal = $r2['price'];
            }

    $nombre_producto = $r2['name'];

    $cantidad = $r['cant'];

    $precio_unidad = $r2['price'];
    $precio_total = $cantidad * $preciototal;
    $imagen_producto = $r2['imagen'];

    $monto_total = $monto_total + $precio_total;

    

    ?>
        <tr>
            <td><?=$nombre_producto?></td>
            <td><?=$cantidad?></td>
            <td><?=$precio_unidad?> <?=$divisa?></td>
        </tr>
    <?php
}
?>
</table>
<br>
<span>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></b></span>

<br><br>
<form method="post" action="?p=carrito">
    <input type="hidden" name="monto_total" value="<?=$monto_total?>"/>
    <button class="btn btn-primary" type="submit" name="finalizar"><i class="fa fa-check"></i> Finalizar Compra</button>
</form>
        </section>
        <footer>
            <div class="contenido_pie">
                <div class="pie_left">
                    <h4>
                        Anaqueles Metálicos García &copy; <?=date("Y")?>
                    </h4>
                </div>
                <div class="pie_right">
                    <h4>
                        Redes sociales
                    </h4>
                    <a href="https://www.facebook.com/"><img src="img/icono_F.png" alt=""></a>
                </div>
            </div>    
        </footer>
    </div>
</body>
</html>
<script type="text/javascript">
	function minimizer(){
		var minimized = $("#minimized").val();

		if(minimized == 0){
			//mostrar
			$(".carritot").css("bottom","350px");
			$(".carritob").css("bottom","0px");
			$("#minimized").val('1');
		}else{
			//minimizar

			$(".carritot").css("bottom","0px");
			$(".carritob").css("bottom","-350px");
			$("#minimized").val('0');
		}
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
