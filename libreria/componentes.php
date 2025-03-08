<?php
function get_api($numero){
    $apis=get_lista_apis();
    return $apis[$numero];
}
function get_lista_apis(){
    $apis = array(
       1 => array(
            'nombre'=>'Predicción de género 👦👧',
            'descripcion'=>'Ingresa un nombre y predice el genero',
            'url'=>'Eje_1',
            'api'=>'https://api.genderize.io?name='
        ),
        array(
            'nombre'=>'Predicción de edad 🎂',
            'descripcion'=>'Ingresa un nombre y predice la edad',
            'url'=>'Eje_2',
            'api'=>'https://api.agify.io?name='
        ),
        array(
            'nombre'=>'Universidades de un país 🎓',
            'descripcion'=>'Ingresa un país en ingles y muestra las universidades',
            'url'=>'Eje_3',
            'api'=>'http://universities.hipolabs.com/search?country='

        ),
        array(
            'nombre'=>'Clima en República Dominicana 🌦️',
            'descripcion'=>'Muestra el clima actual en RD',
            'url'=>'Eje_4',
            'api'=>'https://api.openweathermap.org/data/2.5/weather?lat=18.48&lon=-69.92&appid='
        ),
        array(
            'nombre'=>'Información de un Pokémon ⚡',
            'descripcion'=>'Ingresa un nombre de Pokémon y muestra información',
            'url'=>'Eje_5',
            'api'=>'https://pokeapi.co/api/v2/pokemon/'
        ),
        array(
            'nombre'=>'Noticias desde WordPress 📰',
            'descripcion'=>'Obtiene las últimas 3 noticias de una página de WordPress',
            'url'=>'Eje_6',
            'api'=>''
        ),
        array(
            'nombre'=>'Conversión de Monedas 💰',
            'descripcion'=>'Convierte una cantidad de USD a DOP y otras monedas',
            'url'=>'Eje_7',
            'api'=>'https://api.exchangerate-api.com/v4/latest/USD'
        ),
        array(
            'nombre'=>'Generador de imágenes con IA 🖼️',
            'descripcion'=>'Ingresa una palabra clave y muestra una imagen',
            'url'=>'Eje_8',
            'api'=>''
        ),
        array(
            'nombre'=>'Datos de un país 🌍',
            'descripcion'=>'Ingresa un país y muestra información',
            'url'=>'Eje_9',
            'api'=>'https://restcountries.com/v3.1/name/'
        ),
        array(
            'nombre'=>'Generador de chistes 🤣',
            'descripcion'=>'Muestra un chiste aleatorio',
            'url'=>'Eje_10',
            'api'=>'https://official-joke-api.appspot.com/jokes/random'
        )
    );
    return $apis;
}
?>