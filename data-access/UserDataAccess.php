<?php

    include("Connection.php");

    // Calse encargada del CRUD del usuario
    class UserDataAccess{

        /*
            Encargado del proceso de registro. Verifica si existe una cédula asociada al correo ingresado.
            Si no es el caso, entonces el usuario no existe y se puede crear con ese correo, caso contrario
            si devuelve algo, el correo ya está registrado y no se puede volver a usar. 
            Dado que es información sensible, se envía a través de una solicitud post, que es tomada de php://input y 
            converitda a una clase estándar para su manipulación como objeto
        */
        public static function readRegisteredUsersCredentials(){

            $serverAnswer = json_decode(file_get_contents("php://input"));
            $userName = $serverAnswer->userName;

            $sql = "
                SELECT Cedula as id
                FROM Usuario
                WHERE CorreoElectronico = '$userName'
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            $arrayAnswer = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);

            /*
                Verifica si no hay respuesta y genera un array asociativo que posteriormente se transforma a json
                y se envía al frontend
            */
            if(empty($arrayAnswer)){
                $answer = array('isValidUser' => true);
            }else{
                $answer = array('isValidUser' => false);
            }

            echo json_encode($answer);
        }

        /*
            Encargado del proceso de login. Recibe un json a través de post, y realiza el proceso de conversión
            a una clase estándar. 
        */
        public static function readUserCredentials(){

            $serverAnswer = json_decode(file_get_contents("php://input"));
            $userName = $serverAnswer->userName;
            $password = $serverAnswer->password;

            /* 
                Selecciona el hash almacenado asociado con el correo ingresado
            */
            $sql = "
                SELECT Contrasenia as password
                FROM Usuario
                WHERE CorreoElectronico = '$userName'
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            $credentials = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);

            /*
                Si no hay respuesta, entonces el correo electrónico es correcto y se procede con el proceso
            */
            if(!empty($credentials)){

                // $password es la contraseña ingresada y $credentials[0]['password'] es la contraseña almacenada en la bd
                if(password_verify($password,$credentials[0]['password'])){
                    
                    //Si los datos son correctos se consulta la inforamción necesaria para el frontend
                    $sql = "
                        SELECT Nombre as name, Apellido as lastName, CorreoElectronico as userName
                        FROM Usuario
                        WHERE CorreoElectronico = '$userName'";

                    $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
                    $preparedStatement->execute();
        
                    $credentials = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
                } else {

                    //si la contraseña no coincide, entonces se devuelve un json para el frontend
                    $credentials = array('isRegisteredUser' => false);
                    echo json_encode($credentials);
                    return;
                }
            } else {
                /*
                    Si no hay una respuesta de la BD entonces no existe el correo electrónico y se devuelve un json para 
                    la respuesta en el frontend.
                */
                $credentials = array('isRegisteredUser' => false);
                echo json_encode($credentials);
                return;
            }

            // Se devuelve dicha información
            echo json_encode($credentials[0]);
        }

        /*
            Devuelve la tarjeta de crédito asociada a la cuenta, solo en el momento de confirmar la compra
        */
        public static function readUserCreditCard(){

            $serverAnswer = json_decode(file_get_contents("php://input"));
            $userName = $serverAnswer->userName;

            $sql = "
                SELECT TarjetaCredito as creditCard 
                FROM Usuario
                WHERE CorreoElectronico = '$userName'
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();

            echo json_encode($preparedStatement->fetchAll(PDO::FETCH_ASSOC)[0]);            
        }

        /*
            Recibe un json con los datos válidos del nuevo usuario, y los convierte a una clase standar.
            Almacena esta información en la bd
        */
        public static function createUser(){
            $serverAnswer = json_decode(file_get_contents("php://input"));
            $id = $serverAnswer->id;
            $name = $serverAnswer->name;
            $lastName = $serverAnswer->lastName;
            $userName = $serverAnswer->userName;
            $creditCard = $serverAnswer->creditCard;

            $encryptedPassword = password_hash($serverAnswer->password, PASSWORD_BCRYPT);

            $sql = "
                INSERT INTO Usuario VALUES('$id','$name','$lastName','$userName','$creditCard','$encryptedPassword');
            ";

            $preparedStatement = Connection::getConnectionInstance()->prepare($sql);
            $preparedStatement->execute();
        }
    }
?>