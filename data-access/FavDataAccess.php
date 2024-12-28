<?php

    include_once("Connection.php");
    include_once("Utils.php");

    //clase que maneja el crud de los favoritos
    class FavDataAccess{

        /*
            Devuelve toda la información de los productos que sean favoritos recibiendo por URL el nombre de usuario
        */
        public static function readFavProducts(){
            $userName = $_GET["userName"];

            $sql = "
                SELECT producto.Id as id, producto.Nombre as name, producto.Precio as price, producto.Cantidad as quantity,
                    producto.UnidadesDisponibles as availableUnits,
                    producto.Imagen as image, producto.Marca as brand,
                    producto.Descripcion as description
                FROM Favoritos as favorito, Producto as producto 
                WHERE producto.Id = favorito.IdProducto
                AND favorito.Usuario = '$userName'
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            $dbResult = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);

            Utils::placeServerGroup($dbResult,Connection::$serverName);

            echo json_encode($dbResult);
        }

        /*
            Devuelve solo los id de los productos favoritos para evitar duplicados en el frontend
        */
        public static function readFavProductsId(){
            $userName = $_GET["userName"];

            $sql = "
                SELECT IdProducto as id
                FROM Favoritos
                WHERE Usuario = '$userName'
            
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            echo json_encode($preparedStatement->fetchAll(PDO::FETCH_ASSOC));
        }

        /*
            Añade un producto a favoritos y solicita el id de producto y el nombre de usuario
        */
        public static function addProduct(){
            $userName = $_GET["userName"];
            $productId = $_GET["productId"];

            $sql = "
                INSERT INTO Favoritos VALUES($productId,'$userName')
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
        }

        /*
            Elimina el producto de favoritos sabiendo cual es el usuario y el id de producto
        */
        public static function removeProduct(){
            $userName = $_GET["userName"];
            $productId = $_GET["productId"];

            $sql = "
                DELETE FROM Favoritos
                WHERE Usuario = '$userName'
                AND IdProducto = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
        }
    }
?>