<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de empleados</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>


	<style>
		.content {
			margin-top: 80px;
		}
	</style>


</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de empleados</h2>
			<hr />
                        <?php
				if(isset($_GET['aksi1']) == 'insert'){
					date_default_timezone_set('America/Lima');
					$nik =pg_escape_string($dbconn,(strip_tags($_GET["nik"],ENT_QUOTES)));
					$date = date("Y-m-d H:i:s");
					$horasalida = null;
					$insert = pg_query($dbconn, "INSERT INTO asistencias(codigo, horaingreso, horasalida)
		   			VALUES('$nik','$date',null)") or die("Fallo en insertar");
					if($insert){
								echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Ya registro su ingreso.</div>';

					}else{
								echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
					}
				}
			?>
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			if(isset($_GET['aksi']) == 'update'){
			$nik = pg_escape_string($dbconn,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = pg_query($dbconn, "SELECT * FROM asistencias WHERE codigo='$nik' and horasalida is null");
			if(pg_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = pg_fetch_assoc($sql);
			}
		
			        date_default_timezone_set('America/Lima');
				$horasalida =date("Y-m-d H:i:s");
				
				$update = pg_query($dbconn, "UPDATE asistencias SET horasalida='$horasalida' WHERE codigo='$nik' and horasalida is null") or die("Error en la actualizacion");
				if($update){
						echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Ya registro su salida.</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
	     	}
			?>

			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>Código</th>
					<th>Nombre y Apellidos</th>
					<th>Empresa Proveedora</th>
                    <th>Asistencia</th>
				</tr>
				<?php
				
					$result = pg_query($dbconn, "SELECT * FROM proveedor");
				
				if(pg_num_rows ($result) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = pg_fetch_assoc($result)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['codigo'].'</td>
							<td><a href="edit.php?nik='.$row['codigo'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nombres'].'</a></td>
							<td>'.$row['empresa'].'</td>
							<td>
							    <a href="index.php?aksi1=insert&nik='.$row['codigo'].'" title="Hora de Ingreso" class="btn btn-success btn-sm"><span>Hora de Ingreso</span></a>
								<a href="index.php?aksi=update&nik='.$row['codigo'].'" title="Hora de Salida"  class="btn btn-primary btn-sm"><span>Hora de Salida</span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
	<p>&copy; Sistemas Web <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script language= javascript type= text/javascript >
             MiFuncionJS()
	  { alert (" EXITO")}
	</script >
</body>
</html>
