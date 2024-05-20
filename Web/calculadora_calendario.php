<?php session_start(); ?>
<?php 

if(isset($_GET['mes'])){
$mes_consulta = $_GET['mes'];
}else{
date_default_timezone_set('US/Central');  
$mes_consulta = date("m");
}

if(isset($_GET['anno'])){
    $anno_consulta = $_GET['anno'];
}else{
    date_default_timezone_set('US/Central');  
    $anno_consulta = date("Y");
}

function calcularNahualFecha($fecha_consultar) 
{
    $conn = include "conexion/conexion.php";
    $formato = mktime(0, 0, 0, 1, 1, 1720) / (24 * 60 * 60);
    $fecha = date("U", strtotime($fecha_consultar)) / (24 * 60 * 60);
    $id = $fecha - $formato;
    $nahual = $id % 20;
    if ($nahual < 0) {
        $nahual = 19 + $nahual;
    }
    $Query = $conn->query("SELECT nombre FROM nahual WHERE idweb=".$nahual." ;");
    $row = mysqli_fetch_assoc($Query);
    $query = $row['nombre'];
    return $query;
}

function calcularEnergiaFecha($fecha_consultar)
{
    $for = mktime(0, 0, 0, 1, 1, 1720) / (24 * 60 * 60);
    $fech = date("U", strtotime($fecha_consultar)) / (24 * 60 * 60);
    $idd = $fech - $for;
    $nn = $idd % 13;
    if ($nn<0) {
        $nn=12+$nn;
    }
    if ($nn==12) {
        return 1;
    }else{
        return $nn+2;
    }
}

function calcularHaab($fecha_consultar) 
{
    $fecha1 = new DateTime("1990-04-03");
    $fecha2 = new DateTime($fecha_consultar);
    $fecha_actual = strtotime(date("d-m-Y H:i:00", $fecha1->getTimestamp()));
    $fecha_entrada = strtotime($fecha_consultar);
    $diff = $fecha1->diff($fecha2);
    $dias = $diff->days;
    $reversa = false;
    if ($fecha_actual > $fecha_entrada) {
        $reversa = true;
    }
    if ($reversa) {
        $dias = $dias % 365;
        if ($dias < 360) {
            $mes = 18-ceil($dias / 20);
            $dia = 20-$dias % 20;
        } else {
            $mes = 0;
            $dia = 365-$dias;
        }
    } else {
        if ($dias >= 365) {
            $dias = $dias % 365;
        }
        if ($dias > 5) {
            $dias = $dias - 5;
            $diasmes  = $dias+1;
            $mes = ceil($diasmes / 20);
            $dia = $dias % 20;
        } else {
            $mes = 0;
            $dia = $dias % 20;
        }
    }

    $conn = include "conexion/conexion.php";
    $Query = $conn->query("SELECT nombre FROM uinal WHERE idweb=".$mes." ;");
    $row = mysqli_fetch_assoc($Query);
    $uinal = $row['nombre']." ";
    return strval($dia)." ".$uinal;
}

function imagenSimbolo($base64_imagen, $width = 50) 
{
    return '<img width="'.$width.'" style="filter:brightness(0) invert(1);" src="data:image/png;base64,' . $base64_imagen . '" />';
}

function generarCalendario($calendario, $anno, $mes) 
{
    $cuerpo_tabla = "";

    // Empieza el día en el que cae el 1 del mes
    $primerDia = strtotime($anno.'-'.$mes.'-'.'01');
    $primerDia = strtotime('first day of this month', $primerDia);
    $primerDia = date('w', $primerDia);

    // Crea las celdas vacías hasta el primer día del mes
    $cuerpo_tabla .= "<tr>";
    for ($i = 0; $i < $primerDia; $i++) {
        $cuerpo_tabla .= "<td></td>";
    }
    // Rellena los días del mes
    $diasEnMes = date('t', mktime(0, 0, 0, $mes + 1, 0, $anno));
    for ($dia = 1; $dia <= $diasEnMes; $dia++) {
        if ($primerDia === 7) {
            $primerDia = 0; // Si es domingo, comienza nueva fila
            $cuerpo_tabla .= "<tr>";
        }
        $cuerpo_tabla .= "<td>";
        // Asegúrate de ajustar la ruta y el estilo de la imagen
        $cuerpo_tabla .= '<div class="dia" style="font-size:14px">';
        $cuerpo_tabla .= $dia;
        $cuerpo_tabla .= "<br>Cholquij: ";
        $cuerpo_tabla .= calcularEnergiaFecha($anno."/".$mes."/".$dia). " ";
        $cuerpo_tabla .= calcularNahualFecha($anno."/".$mes."/".$dia);
        $cuerpo_tabla .= "<br>Haab: ";
        $cuerpo_tabla .= calcularHaab($anno."/".$mes."/".$dia);
        $cuerpo_tabla .= '</div>';
        $cuerpo_tabla .= "</td>";
        if ($primerDia === 7) {
            $cuerpo_tabla .= "</tr>";
        }
        $primerDia++;
    }

    // Completa la semana si el último día del mes no es un Sábado
    if ($primerDia !== 7) {
        for ($i = $primerDia; $i < 7; $i++) {
            $cuerpo_tabla .= "<td></td>";
        }
    }
    return $cuerpo_tabla;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tiempo Maya - Calculadora de Mayas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo (rand()); ?>" />
    <link rel="stylesheet" href="css/calculadora.css?v=<?php echo (rand()); ?>" />
</head>

<body>

    <?php include "NavBar.php" ?>
    <div>
        <section id="inicio" style="height:70em">
            <div id="inicioContainer" class="inicio-container">

                <div id='formulario'>
                    <h1>Calculadora Calendario Gregoriano-Maya</h1>
                    <form action="#" method="GET">
                        <div class="mb-1">
                             <?php
                                $meses=array(
                                                    "Enero",
                                                    "Febrero", 
                                                    "Marzo", 
                                                    "Abril", 
                                                    "Mayo", 
                                                    "Junio", 
                                                    "Julio", 
                                                    "Agosto", 
                                                    "Septiembre", 
                                                    "Octubre", 
                                                    "Noviembre", 
                                                    "Diciemrbe"
                                                );
                                $mSelect='<select id="mes" class="form-control" name="mes">';
                                $mes_actual = $mes_consulta;
                                foreach ($meses as $k=>$mes){
                                    $v=$k+1;
                                    if (intval($mes_actual) == intval($v)) {
                                        $mSelect.="<option value=\"$v\" selected>$mes</option>";
                                    } else {
                                        $mSelect.="<option value=\"$v\">$mes</option>";
                                    }
                                }
                                $mSelect.="</select>";
                                echo $mSelect;
                            ?>
                            <?php 
                                //start the select tag 
                                echo '<select id="anno" name="anno" class="form-control">n'; 
                                $anno_actual = $anno_consulta;
                                for ($i=1950;$i<=2050;$i++){
                                    if (intval($anno_actual) == intval($i)) {
                                        echo "<option value=".$i." selected>".$i."</option>n";     
                                    } else {
                                        echo "<option value=".$i.">".$i."</option>n";     

                                    } 
                                } 
                                
                                //close the select tag 
                                echo "</select>"; 
                            ?>
                        </div>
                        <button type="submit" class="btn btn-get-started"><i class="far fa-clock"></i> Calcular</button>
                    </form>

                    <div id="tabla">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>Domingo</th>
                                    <th>Lunes</th>
                                    <th>Martes</th>
                                    <th>Miercoles</th>
                                    <th>Jueves</th>
                                    <th>Viernes</th>
                                    <th>Sabado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo generarCalendario('',$anno_consulta,$mes_consulta)?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
    </div>
    </section>
    </div>

    <?php include "blocks/bloquesJs1.html" ?>

</body>

</html>