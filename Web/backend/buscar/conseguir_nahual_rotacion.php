<?php
$formato = mktime(0, 0, 0, 1, 1, 1720) / (24 * 60 * 60);
$fecha = date("U", strtotime($fecha_consultar)) / (24 * 60 * 60);
$id = $fecha - $formato;
$nahual = $id % 20;
if ($nahual < 0) {
	$nahual = 19 + $nahual;
}
$Query = $conn->query("SELECT kin.id as id FROM nahual JOIN kin ON nahual.idKin = kin.id WHERE idweb=".$nahual.";");
$row = mysqli_fetch_assoc($Query);
$query = $row['id'];
$grados = - (($query-1)*18) - 54;
return $grados;
?>
