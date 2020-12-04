<?php
    session_start();
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if(!$_SESSION['usuario_tipo']=='administrador' && !isset($_GET['id'])){
        header('Location: ../home/');
    }

    $sqlSelect = 'SELECT count(a.id) as numero_solicitudes, c.vacantes, b.fk_usuario FROM solicitud a, alumno b, proyecto c 
                    WHERE a.tipo=0 AND a.estado=1 AND a.fk_usuario=b.fk_usuario AND c.id=a.fk_proyecto AND a.fk_proyecto=
                        (SELECT fk_proyecto FROM solicitud WHERE id='.$_GET['id'].')';

    $num_Solicitudes = 0;
    $num_Vacantes = 0;
    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    if($recordSet->num_rows>0){
        while($row = $recordSet->fetch_assoc()){
            $num_Solicitudes = $row['numero_solicitudes'];
            $num_Vacantes = $row['vacantes'];
        }
    } else {
        #No hay solicitudes
        $_SESSION['mensaje_error'] = 'La solicitud no existe';
        $_SESSION['mensaje_errorF'] = '1';
        header("Location: ../home", true, 303);
    }

    $sqlSelect = 'SELECT a.id FROM profesor a, solicitud b WHERE a.fk_usuario=b.fk_usuario AND b.id='.$_GET['id'];
    $bandera = 0;
    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    if($recordSet->num_rows>0){
        while($row = $recordSet->fetch_assoc()){
            $bandera = 1;
        }
    }

    if($bandera==0 && $num_Solicitudes==$num_Vacantes){
        $mensajeError = "El proyecto ya no tiene vacantes.";
        $_SESSION['mensaje_error'] = $mensajeError;
        $_SESSION['mensaje_errorF'] = '1';
        sleep(2);
        header( "Location: ../home", true, 303);
        exit();
    }

    $sqlSelect = 'SELECT a.id FROM solicitud a, alumno b WHERE a.tipo=0 AND a.estado=1 AND a.fk_usuario=b.fk_usuario AND a.fk_usuario=(SELECT fk_usuario FROM solicitud WHERE id='.$_GET['id'].')';
    $bandera = 0;
    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    if($recordSet->num_rows>0){
        while($row = $recordSet->fetch_assoc()){
            $bandera = 1;
        }
    }

    if($bandera==1){
        $mensajeError = "El alumno ya está en un proyecto.";
        $_SESSION['mensaje_error'] = $mensajeError;
        $_SESSION['mensaje_errorF'] = '1';
        sleep(2);
        header( "Location: ../home", true, 303);
        exit();
    }

    $id_Solicitud = $_GET['id'];
    $sqlUpdate = 'UPDATE solicitud SET estado = 1 WHERE id = '.$id_Solicitud;
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->execute();
    sleep(2);
    header('Location: solicitudes.php', true, 303);
    exit();