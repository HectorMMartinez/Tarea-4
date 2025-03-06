<?php
require("../libreria/motor.php");
plantilla::aplicar();
$n=6;
$api=(object)get_api($n);
if(!$api){
    echo '
    <h1>API no encontrada</h1>
    <p>La API que buscas no existe</p>
    <a href="./" class="button">Regresar</a>
    ';
    exit();
}
?>
<h1 class="title"> <?php echo $api->nombre; ?> </h1>
<p class="subtitle"> <?php echo $api->descripcion;?></p>
<div class="content">
    <form action="<?php echo $api->url; ?>" method="post">
        <input type="text" name="nombre" placeholder="Ingresa un nombre" required>
        <button type="submit" class="button">Enviar</button>
    </form>