<?php
require("../libreria/motor.php");
plantilla::aplicar();
$n=1;
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
<div class="content columns">
    <form class="column is-4" method="post" action="Eje_1/Resultado.php" target="resultado">
        <div class="field">
            <label class="label" for> Nombre: </label>
            <div class="control ">
                <input class="input" type="text" name="nombre" placeholder="Ingresa un nombre" required>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-primary">Enviar</button>
            </div>
        </div>
    </form>
</div>
<iframe name="resultado" style="width:100%; height:300px;">

</iframe>