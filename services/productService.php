<?php
    // Encabezados para política CORS de angular y Chrome
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json"); 

    include("../data-access/ProductDataAccess.php");

    //Se llama según el parámetro en url
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
        if($_GET["operationType"] == "multiple"){
            ProductDataAccess::readAllProducts();
            return;
        }
        if($_GET["operationType"] == "single"){
            ProductDataAccess::readProduct();
            return;
        }
    }
?>