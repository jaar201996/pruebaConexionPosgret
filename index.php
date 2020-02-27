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
