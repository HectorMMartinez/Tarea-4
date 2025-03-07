<?php
require("../libreria/motor.php");

$n=3;
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
    echo "<div class='notification is-warning'><h3 class='title is-4'>❌ No se ha enviado el nombre</h3></div>";
    exit();
}

$nombre = $_POST['nombre'];
$nombre = urlencode($nombre);
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
    <div class="box <?= $background_color ?> has-text-centered">
        <h1 class="title is-3 <?= $text_color ?>">Universidades de <?= $nombre ?></h1>

        <div class="columns is-multiline">
            <?php foreach ($respuesta as $universidad): ?>
                <div class="column is-4">
                    <a href="<?= $universidad->web_pages[0] ?>" target="_blank" class="card">
                        <div class="card-content has-text-centered has-background-primary">
                            <h3 class="title is-4"><?= $universidad->name ?></h3>
                        </div>
                        <footer class="card-footer">
                            <a class="card-footer-item is-link subtitle is-6" href="<?= $universidad->web_pages[0] ?>"><?= $universidad->web_pages[0] ?></a>
                        </footer>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>  
</body>




