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
                    <h1>Calculadora</h1>
                    <form action="#" method="GET">
                        <div class="mb-1">
                             <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo isset($fecha_consultar) ? $fecha_consultar : ''; ?>" >
                        </div>
                        <button type="submit" class="btn btn-get-started"><i class="far fa-clock"></i> Calcular</button>
                    </form>

                    <div id="tabla">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Calendario</th>
                                    <th scope="col" style="width: 60%;">Fecha</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Calendario Cholquij</th>
                                    <td><?php echo isset($cholquij) ? $cholquij : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr style="color:white;">
                                    <td style="text-align:center;">
                                        <div>

                                        <img width="200vw" style="filter:brightness(0) invert(1); transform:rotate(<?php echo $grados_rotacion_numerales;?>deg)" src="data:image/png;base64,<?php echo $base64_rueda_numeral_tzolkin;?>" />
                                        <br>
                                        <img width="300vw" style="filter:brightness(0) invert(1); transform:rotate(<?php echo $grados_rotacion_simbolos;?>deg)" src="data:image/png;base64,<?php echo $base64_rueda_simbolos_tzolkin;?>" />
    
                                    </div>
                                    </td>
                                </tr>
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