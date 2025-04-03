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

$n=5;
$api=(object)get_api($n);
if(!$api){
    echo '
    <div class="notification is-danger">
        <h1 class="title">API no encontrada</h1>
        <p>La API que buscas no existe</p>
        <a href="./" class="button is-dark">Regresar</a>
    </div>';
    exit();
}

if (!$_POST || !isset($_POST['nombre'])) {
    echo "<div class='notification is-danger'><h3 class='title is-4'>❌ Error: No se ha enviado el nombre</h3></div>";
    exit();
}

$nombre = strtolower(trim($_POST['nombre']));
$url = $api->api . "{$nombre}";

$respuesta = file_get_contents($url);
$respuesta = json_decode($respuesta);

if (!$respuesta || !isset($respuesta->sprites->front_default)) {
    echo "<div class='notification is-danger'><h3 class='title is-4'>❌ Error: No se pudo obtener la información del Pokémon</h3></div>";
    exit();
}

$nombre_pokemon = ucfirst($respuesta->name);
$imagen = $respuesta->sprites->front_default;
$experiencia = $respuesta->base_experience;
$habilidades = array_map(function($habilidad) {
    return ucfirst($habilidad->ability->name);
}, $respuesta->abilities);

$tipo_principal = isset($respuesta->types[0]) ? strtolower($respuesta->types[0]->type->name) : "normal";
$tipo_principal= ucfirst($tipo_principal);
$colores_tipos = [
    "fire" => ["has-background-danger-light", "has-text-danger-dark"],
    "water" => ["has-background-info-light", "has-text-info-dark"],
    "grass" => ["has-background-success-light", "has-text-success-dark"],
    "electric" => ["has-background-warning-light", "has-text-warning-dark"],
    "psychic" => ["has-background-primary-light", "has-text-primary-dark"],
    "ice" => ["has-background-link-light", "has-text-link-dark"],
    "dragon" => ["has-background-grey-light", "has-text-grey-darker"],
    "dark" => ["has-background-dark", "has-text-light"],
    "fairy" => ["has-background-danger-light", "has-text-danger-dark"],
    "fighting" => ["has-background-warning", "has-text-light"],
    "rock" => ["has-background-brown", "has-text-light"],
    "ground" => ["has-background-yellow", "has-text-dark"],
    "ghost" => ["has-background-purple", "has-text-light"],
    "poison" => ["has-background-purple-light", "has-text-dark"],
    "steel" => ["has-background-grey-dark", "has-text-light"],
    "bug" => ["has-background-success", "has-text-light"],
    "flying" => ["has-background-light", "has-text-dark"],
    "normal" => ["has-background-grey-lighter", "has-text-dark"]
];

$color_fondo = isset($colores_tipos[$tipo_principal]) ? $colores_tipos[$tipo_principal][0] : "has-background-grey-light";
$color_texto = isset($colores_tipos[$tipo_principal]) ? $colores_tipos[$tipo_principal][1] : "has-text-dark";

?>
<body>
    <div class="box <?= $color_fondo ?> has-text-centered">
        <div class="columns">
            <div class="column">
                <h1 class="title is-3 <?= $color_texto ?>">🎮 Pokémon: <?= $nombre_pokemon ?> 🎮</h1>
                <figure class="image is-128x128 is-inline-block" >
                    <img src="<?= $imagen ?>" alt="<?= $nombre_pokemon ?>">
                </figure>
            </div>
            <div class="column">
                <p class="title is-3 <?= $color_texto ?>"><strong>⭐ Experiencia Base: <?= $experiencia ?></p>
                <p class="title is-3 <?= $color_texto ?>"><strong>Tipo: <?= $tipo_principal?></p>
                <p class="title is-4 <?= $color_texto ?>">🛡️ Habilidades:</p>
                <ul class="subtitle is-5 <?= $color_texto ?>">
                    <?php foreach ($habilidades as $habilidad): ?>
                        <li class="<?= $color_texto ?>">⚡ <?= $habilidad ?></li>
                    <?php endforeach; ?>
                </ul>
                </div>
        </div>
    </div>
</body>
</html>