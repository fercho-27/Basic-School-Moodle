<?php
    session_start();
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if(!$_SESSION['usuario_tipo']=='administrador' && !isset($_GET['id'])){
        header('Location: ../home/');
    }
    $id_Solicitud = $_GET['id'];
    $sqlUpdate = 'UPDATE solicitud SET estado = 2 WHERE id = '.$id_Solicitud;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->execute();
    sleep(2);
    header('Location: solicitudes.php', true, 303);
    exit();