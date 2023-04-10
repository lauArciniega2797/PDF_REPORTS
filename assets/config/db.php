<?php
// define('DB_HOST', '127.0.0.1'); //DB_HOST:  generalmente suele ser "127.0.0.1"
// define('DB_USER', 'mafensauser'); //Usuario de tu base de datos
// define('DB_PASS', 'Mayoreo/1'); //Contraseña del usuario de la base de datos
// define('DB_NAME', 'desarrollo'); //Nombre de la base de datos

// define('DB_HOST', 'www.mafensa.com'); //DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'mafensa_tienda'); //Usuario de tu base de datos
define('DB_PASS', 'a2adk3y3aZLW'); //Contraseña del usuario de la base de datos
// define('DB_NAME', 'mafensa_tienda2'); //Nombre de la base de datos

try {
    $conn = new PDO('mysql:host=www.mafensa.com;dbname=mafensa_tienda2;charset=utf8', DB_USER, DB_PASS);
} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage() . "</br>";
    die();
}

// $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

?>