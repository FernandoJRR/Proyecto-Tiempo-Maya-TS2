<?php session_start(); ?>
<?php 
$conn = include "conexion/conexion.php";

if(isset($_GET['fecha'])){
$fecha_consultar = $_GET['fecha'];
}else{
date_default_timezone_set('US/Central');  
$fecha_consultar = date("Y-m-d");
}

function imagenSimbolo($base64_imagen, $width = 50) 
{
    return '<img width="'.$width.'" style="filter:brightness(0) invert(1);" src="data:image/png;base64,' . $base64_imagen . '" />';
}

$kin_nahual = include 'backend/buscar/conseguir_nahual_nombre_dia.php';
$nahual = include 'backend/buscar/conseguir_nahual_nombre.php';
$energia = include 'backend/buscar/conseguir_energia_numero.php';
$haab = include 'backend/buscar/conseguir_uinal_nombre.php';
$cholquij = $nahual." / ".$kin_nahual." ".strval($energia);

$grados_rotacion_numerales = (($energia-1)*27.7)+8;
$grados_rotacion_simbolos = include 'backend/buscar/conseguir_nahual_rotacion.php';

$base64_rueda_numeral_tzolkin = base64_encode(file_get_contents( __DIR__ .'/imgs/ruedaTzolkin.png'));
$base64_rueda_simbolos_tzolkin = base64_encode(file_get_contents( __DIR__ .'/imgs/ruedaTzolkinSimbolos.png'));
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
                    <h1>Acerca De</h1>
                    <p style="color:white;margin:5%">
                    La cultura maya se refiere a una civilización mesoamericana que destacó a lo largo de más de dos milenios 
                    en numerosos aspectos socioculturales como su escritura jeroglífica, uno de los pocos sistemas de escritura 
                    plenamente desarrollados del continente americano precolombino, su arte, la arquitectura, su mitología y sus 
                    notables sistemas de numeración, así como en astronomía y matemáticas. Se desarrolló en el sureste de México 
                    (en los estados de Yucatán, Campeche, Quintana Roo, Chiapas y Tabasco), prácticamente toda Guatemala y 
                    también en Belice, la parte occidental de Honduras y en El Salvador, abarcando más de 300,000 km. 
                    Esta aplicación permite difundir algunos de los conocimientos de la cultura Maya, como por ejemplo: los diferentes 
                    calendarios Mayas, el conteo del tiempo, los Nahuales y energías. Este proyecto tiene como fin despertar el 
                    interés acerca de la cultura maya y las herramientas que nos brindan nos ayudan a tener una mejor interacción 
                    con el usuario, así como puede llegar hacer un canal de comunicación y construcción del conocimiento con otros interesados.
                    </p>
                    </div>
                </div>

            </div>
    </div>
    </section>
    </div>

    <?php include "blocks/bloquesJs1.html" ?>

</body>

</html>