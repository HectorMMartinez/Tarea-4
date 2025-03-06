<?php
class plantilla{
    static $instancia = null;
    public static function aplicar(){
        if(self::$instancia == null){
            self::$instancia = new plantilla();
        }
        return self::$instancia;
    }
    public function __construct(){
        require("plantilla/cabeza.php");
    }
    public function __destruct(){
        require("plantilla/pie.php");
    }
}
?>