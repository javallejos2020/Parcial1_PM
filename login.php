<?php
	session_start();
	require_once('basedatos/conexion.php');
	
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Iniciar Sesion</h2></center>
			<div class="imgcontainer">
				<img src="imgs/avatar.png" alt="Avatar" class="avatar">
			</div>
		<form action="login.php" method="post">
		
			<div class="inner_container">
				<label><b>Usuario</b></label>
				<input type="text" name="username" required>
				<label><b>Password</b></label>
				<input type="password" name="password" required>

			

				<button class="login_button" name="login" type="submit">Entrar</button>

				
				<a href="registrar.php"><button type="button" class="register_btn">Registrarse</button></a>
			</div>
			<?php
			if(isset($_POST['login']))
			{
				$username=$_POST['username'];
				$password=$_POST['password'];
				$query = "select * from usuario where ci='$username' and clave='$password' ";
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					
					header( "Location: principal.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("No existe el usuario")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Error en la base de datos")</script>';
				}
			}
			
			?>
		</form>	
	</div>
</body>
</html>