<?php
	session_start();
	require_once('basedatos/conexion.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Pagina para registrar</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>REGISTRAR</h2></center>
		<form action="registrar.php" method="post" enctype="multipart/form-data">
			<div class="inner_container">
				<label><b>Usuario (CI)</b></label>
				<input type="text" name="username" required>
				<label><b>Password</b></label>
				<input type="password" name="password" required>
				<label><b>Confirmacion de Password</b></label>
				<input type="password" name="cpassword" required>


				<label><b>Nombre Completo</b></label>
				<input type="text" name="namecom" required>
				<label><b>Fecha de Nacimiento</b></label>
				<input type="date" name="fecha" min="1900-01-01" max="2007-12-12" required><br><br>

				<label><b>Lugar de Recidencia</b></label>
				<select name="residencia">
   					<option value="LP">LP</option> 
   					
   					<option value="CH">CH</option> 
   					<option value="CB">CB</option>
   					<option value="OR">OR</option> 
   					<option value="PT">PT</option> 
   					<option value="TJ">TJ</option> 
   					<option value="SC">SC</option> 
   					<option value="BE">BE</option> 
   					<option value="PD">PD</option> 
				</select><br><br>

				<label><b>Foto de perfil: Subir una imagen con el mismo nombre de usuario</b></label>
				<input type="file"  name="archivo" accept="image/*" required>
				
				
				<button name="register" class="sign_up_btn" type="submit">Registrarse</button>
				<!--</form>-->
				<a href="login.php"><button type="button" class="back_btn">Atras</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
				$username=$_POST['username'];
				$password=$_POST['password'];
				$cpassword=$_POST['cpassword'];
				$namecom=$_POST['namecom'];
				$date=$_POST['fecha'];
				$residencia=$_POST['residencia'];

				if($password==$cpassword)
				{
					$query = "select * from usuario where ci like '$username'";
					
					$query_run = mysqli_query($con,$query);
				
				
				if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("Este nombre de usuario ya existe. ¡Intente con otro!")</script>';
						}
						else
						{
							$query = "INSERT INTO identificador VALUES ('$username','$namecom','$date','$residencia');";
							$query_run = mysqli_query($con,$query);
							$sql = "INSERT INTO usuario VaLUES ('$username','$password','');";
							$sql_run=mysqli_query($con,$sql);
						
							if($query_run and $sql_run)
							{
								
								$_SESSION['username'] = $username;
								$_SESSION['password'] = $password;
								$ruta='perfil/'.$username;	
								$archivo=$ruta.$_FILES["archivo"]["name"];
								$resultado= @move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo);
								
								header("Location: login.php");
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registro fallido debido a un error del servidor. Por favor intente mas tarde</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert(Error en la Base Datos)</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Contraseña y Confirmar contraseña no coinciden")</script>';
				}
				
			}
			else
			{
			}
		?>
	</div>
</body>
</html>