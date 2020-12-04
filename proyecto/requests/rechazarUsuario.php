<?php
    session_start();
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if(!$_SESSION['usuario_tipo']=='administrador' && !isset($_GET['id'])){
        header('Location: ../home/');
    }
    $id_Usuario = $_GET['id'];
    $sqlUpdate = 'UPDATE usuario SET estado = 2 WHERE id = '.$id_Usuario;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->execute();
    sleep(2);
    header('Location: usuarios.php', true, 303);
    exit();