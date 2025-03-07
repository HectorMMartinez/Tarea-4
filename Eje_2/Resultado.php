<?php
require("../libreria/motor.php");

$n=2;
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

if (!$respuesta || !isset($respuesta->age)) {
    echo "<div class='notification is-danger'><h3 class='title is-4'>❌ Error: No se pudo obtener la información</h3></div>";
    exit();
}
$nombre = htmlspecialchars($respuesta->name);
$edad = $respuesta->age;
if ($edad <= 18) {
    $etapa="Joven";
    $background_color="has-background-info-light";
    $text_color="has-text-info-dark";
    $icono="👦";
    $imagen="../images/Joven.png";
} elseif ($edad <= 40) {
    $etapa="Adulto";
    $background_color="has-background-success-light";
    $text_color="has-text-success-dark";
    $icono="🧑";
    $imagen="../images/Adult.png";
} else {
    $etapa="Adulto Mayor";
    $background_color="has-background-danger-light";
    $text_color="has-text-danger-dark";
    $icono="👴";
    $imagen="../images/Viejo.png";
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
    <div class="box <?= $background_color ?> has-text-centered">
        <h1 class="title is-3 <?= $text_color ?>">Resultado <?= $icono ?></h1>
        <figure class="image is-128x128 is-inline-block">
            <img class="is-rounded" src="<?= $imagen ?>" alt="<?= $etapa ?>">
        </figure>
        <p class="title is-5 <?= $text_color ?>"><strong>Nombre: <?= htmlspecialchars($respuesta->name)?> </strong> </p>
        <p class="title is-5 <?= $text_color ?>"><strong>Edad: <?= $edad ?></strong> </p>
        <p class="title is-5 <?= $text_color ?>"><strong>Etapa de Vida: <?= $etapa ?></strong></p>

    </div>  
</body>



