<?php
    // Encabezados para política CORS de angular y Chrome
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json"); 

    include("../data-access/CartDataAccess.php");

    /*
        Como la mayoría son GET, se verifica un parámetro por url que indica a qué método llamar.
    */
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if($_GET["operation"] == "read"){
            CartDataAccess::readUserCartProducts();
            return;
        }
        if($_GET["operation"] == "readId"){
            CartDataAccess::readCartProductsId();
            return;
        }
        if($_GET["operation"] == "add"){
            CartDataAccess::addProduct();
            return;
        }
        if($_GET["operation"] == "addOne"){
            CartDataAccess::increaseProductQuantity();
            return;
        }
        if($_GET["operation"] == "removeOne"){
            CartDataAccess::decreaseProductQuantity();
            return;
        }
        if($_GET["operation"] == "remove"){
            CartDataAccess::removeProduct();
            return;
        }
    }

    // Solo hay 1 operación con DELETE
    if($_SERVER["REQUEST_METHOD"] == "DELETE"){
        CartDataAccess::removeAllCart();
    }
?>