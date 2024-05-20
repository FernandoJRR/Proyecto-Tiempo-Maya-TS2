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
$cuenta_larga = include 'backend/buscar/conseguir_fecha_cuenta_larga.php';
$array_cuenta_larga = explode('.', $cuenta_larga);
$senor_de_la_noche = include 'backend/buscar/conseguir_senor_de_la_noche.php';
$cholquij = $nahual." / ".$kin_nahual." ".strval($energia);

$base64_simbolo_baktun = base64_encode(file_get_contents(__DIR__.'/imgs/baktun.png'));
$base64_simbolo_katun = base64_encode(file_get_contents(__DIR__.'/imgs/katun.png'));
$base64_simbolo_tun = base64_encode(file_get_contents(__DIR__.'/imgs/tun.png'));
$base64_simbolo_uinal = base64_encode(file_get_contents(__DIR__.'/imgs/uinal.png'));
$base64_simbolo_kin = base64_encode(file_get_contents(__DIR__.'/imgs/kin.png'));


$base64_baktun = base64_encode(file_get_contents(__DIR__.'/imgs/NumeralesMaya/'.$array_cuenta_larga[0].'.png'));
$base64_katun = base64_encode(file_get_contents(__DIR__.'/imgs/NumeralesMaya/'.$array_cuenta_larga[1].'.png'));
$base64_tun = base64_encode(file_get_contents(__DIR__.'/imgs/NumeralesMaya/'.$array_cuenta_larga[2].'.png'));
$base64_uinal = base64_encode(file_get_contents(__DIR__.'/imgs/NumeralesMaya/'.$array_cuenta_larga[3].'.png'));
$base64_kin = base64_encode(file_get_contents(__DIR__.'/imgs/NumeralesMaya/'.$array_cuenta_larga[4].'.png'));

$base64_bolontiku = base64_encode(file_get_contents(__DIR__.'/imgs/Bolontiku/'.$senor_de_la_noche.'.png'));
$base64_estela = base64_encode(file_get_contents(__DIR__.'/imgs/estela_calendario.png'));

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
        <section id="inicio" style="height:75em">
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
                                <tr>
                                    <th scope="row">Calendario Haab</th>
                                    <td ><?php echo isset($haab) ? $haab : ''; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Calendario Cholquij</th>
                                    <td><?php echo isset($cholquij) ? $cholquij : ''; ?></td>
                                </tr>
                                    <th scope="row">Cuenta Larga</th>
                                    <td><?php echo isset($cuenta_larga) ? $cuenta_larga : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="padding-right: 15vw;"></td>
                                    <td style="padding-right: 15vw;"></td>
                                    <td><?php echo imagenSimbolo($base64_estela, 140)?></td>
                                </tr>
                                <tr>
                                    <td style="color:white;">Baktun</td>
                                    <td style="color:white;"><?php echo $array_cuenta_larga[0]?></td>
                                    <td><?php echo imagenSimbolo($base64_baktun, 80).imagenSimbolo($base64_simbolo_baktun)?></td>
                                </tr>
                                <tr style="color:white;">
                                    <td>Katun</td>
                                    <td style="color:white;"><?php echo $array_cuenta_larga[1]?></td>
                                    <td><?php echo imagenSimbolo($base64_katun, 80).imagenSimbolo($base64_simbolo_katun)?></td>
                                </tr>
                                <tr style="color:white;">
                                    <td>Tun</td>
                                    <td style="color:white;"><?php echo $array_cuenta_larga[2]?></td>
                                    <td><?php echo imagenSimbolo($base64_tun, 80).imagenSimbolo($base64_simbolo_tun)?></td>
                                </tr>
                                <tr style="color:white;">
                                    <td>Uinal</td>
                                    <td style="color:white;"><?php echo $array_cuenta_larga[3]?></td>
                                    <td><?php echo imagenSimbolo($base64_uinal, 80).imagenSimbolo($base64_simbolo_uinal)?></td>
                                </tr>
                                <tr style="color:white;">
                                    <td>Kin</td>
                                    <td style="color:white;"><?php echo $array_cuenta_larga[4]?></td>
                                    <td><?php echo imagenSimbolo($base64_kin, 80).imagenSimbolo($base64_simbolo_kin)?></td>
                                </tr>
                                <tr style="color:white;">
                                    <td>Señor de la Noche</td>
                                    <td style="color:white;"><?php echo 'G' . $senor_de_la_noche?></td>
                                    <td><?php echo imagenSimbolo($base64_bolontiku, 120)?></td>
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