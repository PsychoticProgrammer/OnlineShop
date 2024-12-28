<?php
    class Connection{

        private static $connectionInstance;
        public static $serverName = "localhost";
        private static $dataBaseName = "OnlineShop";
        private static $dataBaseUser = "root";
        private static $dataBasePassword = "";
        private static $preferences = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        /* Singleton */
        private function __construct(){

        }

        //Cada vez que se llame, retorna la misma conexión pero abierta o la inicializa si no existe
        public static function getConnectionInstance(){
            return self::$connectionInstance != null ? self::$connectionInstance : self::$connectionInstance = self::connect();
        }

        //Se conecta con la base de datos e inicializa la conexión
        private static function connect(){
            try{
                $connection = new PDO("mysql:host=".self::$serverName."; dbname=".self::$dataBaseName,
                                self::$dataBaseUser,self::$dataBasePassword,self::$preferences);
                return $connection;
            }catch(Exception $e){
                die("Error al Intentar Establecer Conexión con la Base de Datos: " . $e->getMessage());
            }
        }
    }
?>