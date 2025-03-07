<?php
require("../libreria/motor.php");

$n=1;
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

if (!$_POST || !isset($_POST['nombre'])) {
    echo "<div class='notification is-warning'><h3 class='title is-4'>⚠ No se ha enviado el nombre</h3></div>";
    exit();
}

$nombre = $_POST['nombre'];
$url = $api->api."{$nombre}";

$respuesta = file_get_contents($url);
$respuesta = json_decode($respuesta);

if (!$respuesta || !isset($respuesta->gender)) {
    echo "<div class='notification is-danger'><h3 class='title is-4'>❌ Error: No se pudo obtener la información</h3></div>";
    exit();
}

$esHombre = $respuesta->gender == "male";
$background_color = $esHombre ? "has-background-info" : "has-background-danger-light"; 
$text_color = $esHombre ? "has-text-white" : "has-text-danger"; 
$icono = $esHombre ? "👦" : "👧";
$genero = $esHombre ? "Hombre" : "Mujer";
$probabilidad = round($respuesta->probability * 100, 2);
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
    <div class="box <?= $background_color ?> has-text-centered">
        <h1 class="title is-3 <?= $text_color ?>">Resultado <?= $icono ?></h1>
        <p class="title is-5 <?= $text_color ?>"><strong>Nombre: <?= htmlspecialchars($respuesta->name)?> </strong> </p>
        <p class="title is-5 <?= $text_color ?>"><strong>Género: <?= $genero ?></strong> </p>
        <p class="title is-5 <?= $text_color ?>"><strong>Probabilidad: <?= $probabilidad ?></strong>%</p>
    </div>  
</body>



