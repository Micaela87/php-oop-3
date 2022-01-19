<?php
/**
     *      
     *      Definire classe Computer:
     *          ATTRIBUTI:
     *          - codice univoco
     *          - modello
     *          - prezzo
     *          - marca
     * 
     *          METODI:
     *          - costruttore che accetta codice univoco e prezzo
     *          - proprieta' getter/setter per tutte le variabili d'istanza
     *          - printMe: che stampa se stesso (come quella vista a lezione)
     *          - toString: "marca modello: prezzo [codice univoco]"
     * 
     *          ECCEZIONI:
     *          - codice univoco: deve essere composto da esattamente 6 cifre (no altri caratteri)
     *          - marca e modello: devono essere costituiti da stringhe tra i 3 e i 20 caratteri
     *          - prezzo: deve essere un valore intero compreso tra 0 e 2000
     * 
     *      Testare la classe appena definita con tutte le casistiche interessanti per verificare
     *      il corretto funzionamento dell'algoritmo
     * 
*/

class Computer {
    private $sku, $model, $price, $brand;

    private static $skuErrorMessage = "La lunghezza dello sku deve essere di 6 caratteri e deve contenere SOLO numeri";
    private static $modelBrandErrorMessage = "La lunghezza dei dati inseriti deve essere compresa tra 3 e 20";
    private static $priceErrorMessage = "Il prezzo deve essere compreso tra 0 e 2000";

    private static function checkBrandModel($string) {
        return gettype($string) === 'string' && strlen($string) > 3 && strlen($string) < 20;
    }

    private static function handleError($message) {
        throw new Exception($message);
    }

    function __construct($sku, $price) {
        $this -> setSku($sku);
        $this -> setPrice($price);
    }

    function getSku() {
        return $this -> sku;
    }

    function setSku($sku) {
        if (strlen($sku) === 6 && preg_match("/\d{6}/", $sku)) {
            $this -> sku = $sku;
        } else {
            self::handleError(self::$skuErrorMessage);
        }
        
    }

    function getModel() {
        return $this -> model;
    }

    function setModel($model) {
        if ($this -> checkBrandModel($model)) {
            $this -> model = $model;
        } else {
            self::handleError(self::$modelBrandErrorMessage);
        }
        
    }

    function getPrice() {
        return $this -> price;
    }

    function setPrice($price) {
        if (is_int($price) && ($price > 0 && $price < 2000)) {
            $this -> price = $price;
        } else {
            self::handleError(self::$priceErrorMessage);
        }
        
    }

    function getBrand() {
        return $this -> brand;
    }

    function setBrand($brand) {
        if ($this -> checkBrandModel($brand)) {
            $this -> brand = $brand;
        } else {
            self::handleError(self::$modelBrandErrorMessage);
        }
    }

    function printMe() {
        echo $this;
    }

    function __toString() {
        return $this -> getBrand() . " " . $this -> getModel() . ": " . $this -> getPrice() . " [" . $this -> getSku() . "]";
    }
}

/* 
     * 
     *      Definire classe User:
     *          ATTRIBUTI (private):
     *          - username 
     *          - password
     *          - age
     *          
     *          METODI:
     *          - costruttore che accetta username, e password
     *          - proprieta' getter/setter
     *          - printMe: che stampa se stesso
     *          - toString: "username: age [password]"
     * 
     *          ECCEZIONI:
     *          - scatenare eccezione quando username e' minore di 3 caratteri o maggiore di 16
     *          - scatenare eccezione se password non contiene un carattere speciale (non alpha-numerico)
     *          - scatenare eccezione se age non e' un numero
     * 
     *          NOTE:
     *          - per testare il singolo carattere di una stringa
     * 
     *      Testare la classe appena definita con dati corretti e NON corretti all'interno di un
     *      try-catch e eventualmente informare l'utente del problema
     * 
     * 
*/

class User {
    private $username, $password, $age;

    private static $usernameErrorMessage = "Username deve essere minimo 3 massimo 16 caratteri";
    private static $pwdErrorMessage = "Password deve contenere almeno 1 carattere speciale";
    private static $ageErrorMessage = "L'età deve essere un numero compreso tra 1 e infinito";

    private static function handleError($message) {
        throw new Exception($message);
    }

    function __construct($username, $password) {
        $this -> setUserName($username);
        $this -> setPwd($password);
    }

    function getUserName() {
        return $this -> username;
    }

    function setUserName($username) {
        if (strlen($username) > 3 && strlen($username) < 16) {
            $this -> username = strtolower($username);
        } else {
            self::handleError(self::$usernameErrorMessage);
        }
        
    }

    function getPwd() {
        return $this -> password;
    }

    function setPwd($password) {
        $pattern = "/[\.\^\$\*\+\-\?\(\)\[\]\{\}\\\|\—\!\@]/";
        if (preg_match($pattern, $password)) {
            $this -> password = $password;
        } else {
            self::handleError(self::$pwdErrorMessage);
        }
         
    }

    function getAge() {
        return $this -> age;
    }

    function setAge($age) {
        if (is_int($age) && $age > 0) {
            $this -> age = $age;
        } else {
            self::handleError(self::$ageErrorMessage);
        }
        
    }

    function printMe() {
        echo $this;
    }

    function __toString() {
        return $this -> getUserName() . ": " . $this -> getAge() . " [" . $this -> getPwd() . "]";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        

        try {
            $computer = new Computer("123444", 1000);
            
            $computer -> setBrand("123456");
            $computer -> setModel("123456HP");

        } catch (Exception $e) {
            echo 'Errore: ' .  $e->getMessage() . "<br>";
        }

        echo $computer . "<br>";

        try {
            $user = new User("franc", "pwd123");
            
            $user -> setAge("35");

        } catch (Exception $e) {
            echo 'Errore: ' .  $e->getMessage() . "<br>";
        }

        echo $user . "<br>";
    ?>

</body>
</html>