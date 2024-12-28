<?php

    include_once("Connection.php");
    include_once("Utils.php");

    //Clase que maneja el CRUD de productos
    class ProductDataAccess{

        /*
            Devuelve la información básica de todos los productos disponibles
        */
        public static function readAllProducts(){
            $sql = "
            SELECT Id as id, Nombre as name, Cantidad as quantity, Precio as price, 
                    UnidadesDisponibles as availableUnits, Imagen as image
            FROM Producto
            WHERE UnidadesDisponibles > 0;
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            if(!$preparedStatement->execute()){
                die("ERROR AL SELECCIONAR LOS PRODUCTOS");
            }

            $dbResult = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);

            Utils::placeServerGroup($dbResult,Connection::$serverName);

            echo json_encode($dbResult);
        }

        /*
            Devuelve solo 1 producto recibiendo el id del mismo, y trae toda la información
        */
        public static function readProduct(){
            $productId = $_GET["productId"];
            $sql = "
            SELECT Id as id, Nombre as name, Cantidad as quantity, Precio as price, 
                UnidadesDisponibles as availableUnits, Imagen as image, Marca as brand,
                Descripcion as description
            FROM Producto
            WHERE Id = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
 
            $dbResult = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);

            Utils::placeServerGroup($dbResult,Connection::$serverName);

            echo json_encode($dbResult);
        }
    }
?>