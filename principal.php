<?php
	session_start();
	require_once('basedatos/conexion.php');

	$usuario=$_SESSION['username'];
	if (!isset($usuario)) {
		header("Location: login.php");
	}
	else{
?>

<!DOCTYPE html>
<html>
<head>
<title>Pagina inf 324</title>

<?php 
$user=$_SESSION['username'];
$sql= "select color from usuario where ci like '$user'";
$query = mysqli_query($con,$sql);
$css='';
while ($mostrar=mysqli_fetch_array($query)) {

$css=$mostrar['color'];
}
?>	
<link rel="stylesheet" href="css/style<?php echo $css;?>.css">
</head>
<body>
	<div id="menu-fondo" >
		<form action="salir.php" method="post">
			<div class="imgcontainer" >
 				<header>
 				<?php	
				$user=$_SESSION['username'];
				$dire="perfil/";
				$exten=".jpg";
				$nombre=$dire.$user.$user.$exten;
				?>
				<img src="<?php echo $nombre; ?>" width="80" height="80" />
				<?php 
				$sql = "select nombreCompleto from identificador where ci like '$user'";
				$query = mysqli_query($con,$sql);
				while ($mostrar=mysqli_fetch_array($query)) {
				?>
				<td><?php echo $mostrar['nombreCompleto']?></td>
				<?php
				}
				?>	
				<nav>
					<button class="logout_bntSesion" type="submit" name="cerrar">Cerrar Sesion</button>
				</nav>
    			</header>
			</div>
                <br><br><br><br><br><br>
                <center><h2>BIENVENIDO A MI PAGINA DE INF-324</h2></center>
        </form>
        <div style="text-align:center;">
        <nav>
			 	<form action="principal.php" method="post">
        			<button class="logout_bnt1" type="submit" name="btnrojo">Rojo</button>
        			<button class="logout_bnt2" type="submit" name="btnamarillo">Amarillo</button>
        			<button class="logout_bnt3" type="submit" name="btnverde">Verde</button>
        		</form>
		</nav>
        </div> 
        <?php
        			$user=$_SESSION['username']; 
        			//echo "$user";
        			if (isset($_POST['btnrojo'])) {
        				//echo "$user";
        				$color='Rojo';
        				$sql="UPDATE usuario SET color = '$color' WHERE ci like '$user'";
        				$query_run = mysqli_query($con,$sql);
        				header('Location: principal.php');
        			}
        			if (isset($_POST['btnamarillo'])) {
        					$color='Amarillo';
        					$sql="UPDATE usuario SET color = '$color' WHERE ci like '$user'";
        					$query_run = mysqli_query($con,$sql);
        					header('Location: principal.php');	
        			}
        			if (isset($_POST['btnverde'])) {
        				$color='Verde';
        				$sql="UPDATE usuario SET color = '$color' WHERE ci like '$user'";
        				$query_run = mysqli_query($con,$sql);
        				header('Location: principal.php');
        			}
        						
        ?>
        <div style="text-align: center;" align="center">
        <br><br>
        <center><h2>Problema 2</h2></center><br>
        <p><h4>--> Con la Base de datos anterior, adicione una tabla de notas por materia y cuente la cantidad de aprobados por departamento de manera que solo obtenga una sola fila de resultados (con codigo PHP).</h4></p><br>

        <center><h3>Consulta normal</h3></center><br>
        <table border="1" cellspacing=1 cellpadding=2 style="font-size: 8pt"><tr>
        <td><font face="verdana"><b>residencia</b></font></td>
        <td><font face="verdana"><b>cantidad</b></font></td>
        </tr>

        <?php  
  
         $query = "select i.residencia ,count(*) cantidad
           from nota n, identificador i
           where n.ci=i.ci and n.notaFinal>50
           GROUP by i.residencia";
         $result = mysqli_query($con,$query);
  
         while($row = mysqli_fetch_array($result))
         {
           echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
               $row["residencia"] . "</font></td>";
            echo "<td width=\"25%\"><font face=\"verdana\">" . 
               $row["cantidad"] . "</font></td></tr>";
          }
        ?>
        </table>


        <br><br><center><h3>Consulta en una sola fila</h3></center><br>
        <table border="1" cellspacing=1 cellpadding=2 style="font-size: 8pt" align="center">
            <tr>
            <td><font face="lugar"><b>La Paz</b></font></td>
            <td><font face="lugar"><b>Chuquisaca</b></font></td>
            <td><font face="lugar"><b>Cochabamba</b></font></td>
            <td><font face="lugar"><b>Oruro</b></font></td>
            <td><font face="lugar"><b>Potosi</b></font></td>
            <td><font face="lugar"><b>Tarija</b></font></td>
            <td><font face="lugar"><b>Santa Cruz</b></font></td>
            <td><font face="lugar"><b>Beni</b></font></td>
            <td><font face="lugar"><b>Pando</b></font></td>
            </tr>
        </div>
            <?php  
            $query = "SELECT count(case when a.residencia like 'LP' then n.notaFinal end) as 'La Paz',
            count(case when a.residencia like 'CH' then n.notaFinal end) as 'Chuquisaca',
            count(case when a.residencia like 'CB' then n.notaFinal end) as 'Cochabamba',
            count(case when a.residencia like 'OR' then n.notaFinal end) as 'Oruro',
            count(case when a.residencia like 'PT' then n.notaFinal end) as 'Potosi',
            count(case when a.residencia like 'TJ' then n.notaFinal end) as 'Tarija',
            count(case when a.residencia like 'SC' then n.notaFinal end) as 'Santa Cruz',
            count(case when a.residencia like 'BE' then n.notaFinal end) as 'Beni',
            count(case when a.residencia like 'PD' then n.notaFinal end) as 'Pando'
            FROM identificador as a, nota as n
            where a.ci like n.ci and n.notaFinal > 50";
              $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result)){
                echo "<tr><td width=\"10%\"><font face=\"lugar\">" . 
                    $row["La Paz"] . "</font></td>";
                echo "<td width=\"10%\"><font face=\"lugar\">" . 
                    $row["Chuquisaca"] . "</font></td>";
                echo "<td width=\"10%\"><font face=\"lugar\">" . 
                    $row["Cochabamba"] . "</font></td>";
                echo "<td width=\"10%\"><font face=\"lugar\">" . 
                    $row["Oruro"]. "</font></td>";
                echo "<td width=\"10%\"><font face=\"lugar\">" . 
                    $row["Potosi"] . "</font></td>";
                echo "<td width=\"10%\"><font face=\"lugar\">" . 
                    $row["Tarija"] . "</font></td>";
                echo "<td width=\"10%\"><font face=\"lugar\">" . 
                    $row["Santa Cruz"] . "</font></td>";
                echo "<td width=\"10%\"><font face=\"lugar\">" . 
                    $row["Beni"] . "</font></td>";
                echo "<td width=\"10%\"><font face=\"lugar\">" . 
                    $row["Pando"] . "</font></td></tr>";     
            }
            ?>
            </table>
            
        </div>
</body>
</html>
<?php } ?>