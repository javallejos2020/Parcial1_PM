<?php
	session_start();
	require_once('basedatos/conexion.php');
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Notas</title>
</head>
<body>


<table border="1" cellspacing=1 cellpadding=2 style="font-size: 8pt"><tr align="cellpadding">
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


<table border="1" cellspacing=1 cellpadding=2 style="font-size: 8pt"><tr>
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
where a.ci like n.ci and n.notaFinal > 50
";
  $result = mysqli_query($con,$query);
  
  while($row = mysqli_fetch_array($result))
  {
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







<!--        <?php 
            $resi=$_SESSION['residencia'];
            $sql = "SELECT count(case when a.residencia like '$resi' then n.notaFinal end) as 'La Paz', count(case when a.residencia like 'CH' then n.notaFinal end) as 'Chuquisaca', count(case when a.residencia like 'CB' then n.notaFinal end) as 'Cochabamba', count(case when a.residencia like 'OR' then n.notaFinal end) as 'Oruro', count(case when a.residencia like 'PT' then n.notaFinal end) as 'Potosi', count(case when a.residencia like 'TJ' then n.notaFinal end) as 'Tarija', count(case when a.residencia like 'SC' then n.notaFinal end) as 'Santa Cruz', count(case when a.residencia like 'BE' then n.notaFinal end) as 'Beni', count(case when a.residencia like 'PD' then n.notaFinal end) as 'Pando' FROM identificador as a, nota as n where a.ci like n.ci and n.notaFinal > 50";
            $query = mysqli_query($con,$sql);
            while ($mostrar=mysqli_fetch_array($query)) {
        ?>
            <td><?php echo $mostrar['nombreCompleto']?></td>
        <?php
            }
        ?>-->
</body>
</html>
