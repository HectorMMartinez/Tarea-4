<?php
require("libreria/motor.php");
plantilla::aplicar();
?>
            <h1 class="title"> Libreria de Apis 🐝 </h1>
            <div class="content">
                <p>Para ver el contenido de la api, seleccione una de las opciones:</p>
                <ul>
                   <?php
                   $apis=get_lista_apis();
                     foreach($apis as $api){
                          echo '<li><a href="'.$api['url'].'"><strong>'.$api['nombre'].'</strong></a> - '.$api['descripcion'].'</li>';
                     }
                   ?> 
                </ul>
            </div>
