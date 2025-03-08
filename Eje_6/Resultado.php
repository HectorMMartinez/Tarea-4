<head>
    <link rel="stylesheet" href="../bulma-1.0.2/bulma/css/bulma.css">
    <style>
        html, body{
            overflow: hidden;
        }
    </style>
</head>
<?php
require("../libreria/motor.php");

$n=6;
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

</body>



