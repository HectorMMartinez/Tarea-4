<?php
require("../libreria/motor.php");

$n=4;
$api=(object)get_api($n);
if(!$api){
    echo '
    <div class="notification is-danger">
        <h1 class="title">API no encontrada</h1>
        <p>La API que buscas no existe</p>
        <a href="./" class="button is-dark">Regresar</a>
    </div>
    ';
    exit();
}

$key='cbfa8c801a1d80a4175ae058cba5bb59';
$unidad = isset($_POST['unidad']) ? $_POST['unidad'] : 'Standard';
$url = $unidad === 'Standard' ? "{$api->api}{$key}" : "{$api->api}{$key}&units={$unidad}";
$simbolo=$unidad=='Metric' ? "C" : ( $unidad=='Imperial' ? "F" : 'K' );
$respuesta = file_get_contents($url);
$respuesta = json_decode($respuesta);

$ciudad = isset($respuesta->name) ? $respuesta->name : 'Desconocido';
$pais = isset($respuesta->sys->country) ? $respuesta->sys->country : 'Desconocido';
$temperatura = isset($respuesta->main->temp) ? round($respuesta->main->temp, 1) : 'No disponible';
$descripcion = isset($respuesta->weather[0]->description) ? ucfirst($respuesta->weather[0]->description) : 'No disponible';
$humedad = isset($respuesta->main->humidity) ? $respuesta->main->humidity : 'No disponible';
$presion = isset($respuesta->main->pressure) ? $respuesta->main->pressure : 'No disponible';
$viento = isset($respuesta->wind->speed) ? round($respuesta->wind->speed, 1) : 'No disponible';


$condicion = strtolower($respuesta->weather[0]->main);
$icono_api = $respuesta->weather[0]->icon;
$icono = "☁️"; 
$color = "has-background-grey-light";
if (strpos($condicion, 'clear') !== false) {
    $icono = "☀️";
    $color = "has-background-warning-light";
} elseif (strpos($condicion, 'rain') !== false) {
    $icono = "🌧️";
    $color = "has-background-info-light";
} elseif (strpos($condicion, 'cloud') !== false) {
    $icono = "☁️";
    $color = "has-background-grey-light";
}

?>
<head>
    <link rel="stylesheet" href="../bulma-1.0.2/bulma/css/bulma.css">
    <style>
        html, body {
            overflow: hidden;
        }
    </style>

</head>
<body>

<div class="box <?= $color ?> has-text-centered">
        <h1 class="title is-3"><?= $icono ?> Clima en <?= $ciudad ?>, <?= $pais ?></h1>
        <figure class="image is-128x128 is-inline-block">
            <img src="https://openweathermap.org/img/wn/<?= $icono_api ?>@2x.png" alt="Weather Icon">
        </figure>
        <p class="title has-text-white is-4"><strong>🌡️ Temperatura:</strong> <?= $temperatura ?> °<?= $simbolo ?></p>
        <p class="subtitle has-text-white is-5"><strong>📌 Condiciones: <?= $descripcion ?> </strong></p>
        <p class="subtitle has-text-white is-5"><strong>💧 Humedad: <?= $humedad ?>%</strong></p>
        <p class="subtitle has-text-white is-5"><strong>🌬️ Viento: <?= $viento ?> km/h </strong></p>
        <p class="subtitle has-text-white is-5"><strong>📊 Presión:<?= $presion ?> hPa </strong></p>
    </div>
</body>