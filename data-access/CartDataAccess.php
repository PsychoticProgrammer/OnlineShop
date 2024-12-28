<?php

    include_once("Connection.php");
    include_once("Utils.php");

    //Clase que maneja el Crud del Carrito
    class CartDataAccess{

        /*
            Deveulve toda la información de los productos que correspondan con el usuario logueado, para lo cual
            recibe a través de url el correo electrónico del usuario
        */
        public static function readUserCartProducts(){
            $userName = $_GET["userName"];

            $sql = "
                SELECT producto.Id as id, producto.Nombre as name, producto.Precio as price, producto.Cantidad as quantity,
                    producto.UnidadesDisponibles as availableUnits,
                    producto.Imagen as image, producto.Marca as brand,
                    producto.Descripcion as description,
                    carrito.Cantidad as cartQuantity
                FROM Carrito as carrito, Producto as producto 
                WHERE producto.Id = carrito.IdProducto
                AND carrito.Usuario = '$userName'
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            $dbResult = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);

            Utils::placeServerGroup($dbResult,Connection::$serverName);

            echo json_encode($dbResult);
        }

        /* 
            Devuelve solo los id de los productos que están en carrito para evitar duplicar la info del carrito
            ya que va a variable global
        */
        public static function readCartProductsId(){
            $userName = $_GET["userName"];

            $sql = "
                SELECT IdProducto as id
                FROM Carrito
                WHERE Usuario = '$userName'
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            echo json_encode($preparedStatement->fetchAll(PDO::FETCH_ASSOC));
        }

        /*
            Agrega un producto y recibe como parámetros el nombre de usuario y el id del producto a agregar
            En principio solo puede agregar 1 producto, por tanto no se envía la cantidad
        */
        public static function addProduct(){
            $userName = $_GET["userName"];
            $productId = $_GET["productId"];

            $sql = "
                INSERT INTO Carrito VALUES($productId,1,'$userName')
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();


            /* 
                Una vez guardado el producto, es necesario reducir las unidades disponibles en la tabla producto
            */ 
            $sql = "
                UPDATE Producto SET UnidadesDisponibles = UnidadesDisponibles - 1
                WHERE id = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
        }

        /*
            Cuando se actualiza la cantidad en carrito aumentándola, se solicita la cantidad actualizada así como el id del producto
            y el nobre de usuario
        */
        public static function increaseProductQuantity(){
            $userName = $_GET["userName"];
            $productId = $_GET["productId"];
            $quantity = $_GET["quantity"];

            $sql = "
                UPDATE Carrito SET Cantidad = Cantidad + $quantity
                WHERE Usuario = '$userName'
                AND IdProducto = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
            
            /*
                De igual modo, se debe actualizar las unidades disponibles del producto
            */
            $sql = "
                UPDATE Producto SET UnidadesDisponibles = UnidadesDisponibles - $quantity
                WHERE id = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            self::readProductNewAvailableUnits($productId);
        }

        /*
            Cuando se actualiza la cantidad en carrito disminuyéndola, se solicita la cantidad actualizada así como el id del producto
            y el nobre de usuario
        */
        public static function decreaseProductQuantity(){
            $userName = $_GET["userName"];
            $productId = $_GET["productId"];
            $quantity = $_GET["quantity"];

            $sql = "
                UPDATE Carrito SET Cantidad = Cantidad - $quantity
                WHERE Usuario = '$userName'
                AND IdProducto = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
            
             /*
                De igual modo, se debe actualizar las unidades disponibles del producto
            */
            $sql = "
                UPDATE Producto SET UnidadesDisponibles = UnidadesDisponibles + $quantity
                WHERE id = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
            self::readProductNewAvailableUnits($productId);
        }

        /*
            Si se elimina un producto del carrito modifica la base de datos, y solicita el nombre de usuario y el id de producto
        */
        public static function removeProduct(){
            $userName = $_GET["userName"];
            $productId = $_GET["productId"];

            /*
                Consulta primero cuál es la cantidad actual de productos en el carrito
            */
            $sql = "
                SELECT Cantidad as  quantity
                FROM Carrito
                WHERE Usuario = '$userName'
                AND IdProducto = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
            
            $quantity = $preparedStatement->fetchAll(PDO::FETCH_ASSOC)[0]['quantity'];

            /*
                Elimina el producto del carrito
            */
            $sql = "
                DELETE FROM Carrito
                WHERE Usuario = '$userName'
                AND IdProducto = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
            
            /*
                Actualiza la cantidad disponible del carrito sumando el valor obtenido al principio
            */
            $sql = "
                UPDATE Producto SET UnidadesDisponibles = UnidadesDisponibles + $quantity
                WHERE id = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            self::readProductNewAvailableUnits($productId);
        }

        /*
            Vacía el carrito cuando se compran todos los productos en Carrito y recibe solo el usuario porque 
            y no importa que producto se elimine
        */
        public static function removeAllCart(){
            $userName = $_GET["userName"];

            $sql = "
                DELETE FROM Carrito
                WHERE Usuario = '$userName'
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
        }

        /* 
            Se aisló en una función el proceso de reconsultar las unidades disponibles para evitar repetir código
            y lo que hace es devolver las nuevas unidades teniendo el id del producto como parámetro
        */
        private static function readProductNewAvailableUnits($productId){
            $sql = "
            SELECT UnidadesDisponibles as availableUnits
            FROM Producto
            WHERE Id = $productId
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            // echo json_encode($preparedStatement->fetchAll(PDO::FETCH_ASSOC)[0]);
            return json_encode($preparedStatement->fetchAll(PDO::FETCH_ASSOC)[0]);
        }
    }
?>