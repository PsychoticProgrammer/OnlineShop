<?php
    // Encabezados para política CORS de angular y Chrome
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");

    include("../data-access/UserDataAccess.php");

    /* 
        Como todos son post, se verifica un parámetro enviado por url que indica a qué método se debe llamar
    */
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        switch($_GET["operation"]){
            
            case "validateRegister":
                UserDataAccess::readRegisteredUserscredentials();
                return;
            case "login":
                UserDataAccess::readUserCredentials();
                return;
            case "creditCard":
                UserDataAccess::readUserCreditCard();
                return;
            case "register":
                UserDataAccess::createUser();
                return;

        }
    }
?>