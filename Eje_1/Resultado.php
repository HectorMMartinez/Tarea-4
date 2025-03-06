<?php
if(!$_POST||!isset($_POST['nombre'])){
    echo "No se ha enviado el nombre";
    exit();

}

$nombre = $_POST['nombre'];

$url = "https://api.genderize.io?name={$nombre}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$respuesta = curl_exec($ch);
curl_close($ch);
$respuesta = json_decode($respuesta);
var_dump($respuesta);
$respuesta->gender=($respuesta->gender=="male")?"Hombre":"Mujer";
echo "<h1>Resultado</h1>";
echo "<h3>Nombre:" . $respuesta->name . "</h3>";
echo "<h3>Genero:" . $respuesta->gender . "</h3>"; 
echo "<h3>Probabilidad" . $respuesta->probability*100 . "%</h3>";