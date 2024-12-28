<?php
    class Utils{
        /*
            Para colocar la dirección de las imágenes del servidor, dado que en Google Cloud la ip cambia 
            en cada inicio de la máquina virtual.
            Solo coloca la imagen en 1 resultado para cuando se llama a solo 1 producto
        */
        public static function placeServer($imageDirection, $serverName){
            return "http://" . $serverName . $imageDirection;
        }

        /*
            Para colocar la dirección de las imágenes del servidor, dado que en Google Cloud la ip cambia 
            en cada inicio de la máquina virtual.
            Coloca la imagen en todo un set de respuesta, y recibe dicho set como una referencia &$dbResult
            para conservar los cambios que se hacen en el ciclo. 
        */
        public static function placeServerGroup(&$dbResult, $serverName){
            for($i = 0; $i < count($dbResult); $i++){
                $dbResult[$i]['image'] = self::placeServer($dbResult[$i]['image'],$serverName);
            }
        }
    }
?>