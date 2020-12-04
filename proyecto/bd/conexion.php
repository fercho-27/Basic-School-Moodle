<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbdata = 'bd-web';

    $conn = new mysqli($dbhost,$dbuser,$dbpass,$dbdata);
	$conn->set_charset("utf8");

    if($conn->connect_error){
        //die('Hubo un error al conectarse a la base de datos!!!');
        echo 'No se pudo conectar a la base de datos.';
    }