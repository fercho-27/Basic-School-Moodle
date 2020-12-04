<?php
    session_start();
    require_once '../includes/header.php';
    require_once '../bd/conexion.php';

    if(isset($_SESSION['login'])){
        if($_SESSION['login']=='1'){
            header('Location: ../home');
        }
    }
    
    if(isset($_SESSION['mensaje_registro']) && isset($_SESSION['mensaje_registroF']) && $_SESSION['mensaje_registroF']=='1'){
        $mensajeExito = $_SESSION['mensaje_registro'];
        $_SESSION['mensaje_registroF'] = '0';
    }

    if(isset($_POST['btnEntrar'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $tipo = $_POST['tipo'];
        $sqlSelect = 'SELECT a.username, a.password, a.id, b.fk_usuario, b.nombre, a.estado FROM usuario a, '.$tipo.' b
                    WHERE a.username = ? and a.password = ? and a.id = b.fk_usuario';
        $stmt = $conn->prepare($sqlSelect);
        $stmt->bind_param('ss',$usuario,$password);
        $stmt->execute();
        $recordSet = $stmt->get_result();
        if($recordSet->num_rows == 1){
            $row = $recordSet->fetch_assoc();
                if($row['estado']==1){
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['usuario_tipo'] = $tipo;
                    $_SESSION['nombre_usuario'] = $row['nombre'];
                    echo $row['nombre'];
                    $_SESSION['login'] = "1";
                    header('Location:../home');
            } else if($row['estado']==0){
                $mensajeError = 'Usuario no aceptado todavía.';
            } else {
                $mensajeError = 'Usuario rechazado';
            }
        } else{
            $mensajeError = 'Credenciales no válidas.';
        }
    }

    require_once 'indexForma.php';
    require_once '../includes/piepagina.php';
    require_once '../includes/footer.php';