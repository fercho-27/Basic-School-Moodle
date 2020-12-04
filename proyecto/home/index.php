<?php
    session_start();
    require_once '../includes/header.php';
    require_once '../bd/conexion.php';
    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    }
    if(isset($_SESSION['mensaje_registro']) && isset($_SESSION['mensaje_registroF']) && $_SESSION['mensaje_registroF']=='1'){
        $mensajeExito = $_SESSION['mensaje_registro'];
        $_SESSION['mensaje_registroF'] = '0';
    }
    if(isset($_SESSION['mensaje_error']) && isset($_SESSION['mensaje_errorF']) && $_SESSION['mensaje_errorF']=='1'){
        $mensajeError = $_SESSION['mensaje_error'];
        $_SESSION['mensaje_errorF'] = '0';
    }
    require_once 'indexForma.php';
    require_once '../includes/piepagina.php';
    require_once '../includes/footer.php';