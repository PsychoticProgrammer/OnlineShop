<?php
    // Encabezados para política CORS de angular y Chrome
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json"); 

    include_once("../data-access/FavDataAccess.php");

    //Se verifica el parámetro por URL para llamar al método
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if($_GET["operation"] == "read"){
            FavDataAccess::readFavProducts();
            return;
        }
        if($_GET["operation"] == "readId"){
            FavDataAccess::readFavProductsId();
            return;
        }
        if($_GET["operation"] == "add"){
            FavDataAccess::addProduct();
            return;
        }
    }

    // Si es DELETE
    if($_SERVER["REQUEST_METHOD"] == "DELETE"){
        FavDataAccess::removeProduct();
        return;
    }
?>