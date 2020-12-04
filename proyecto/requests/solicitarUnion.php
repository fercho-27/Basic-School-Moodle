<?php
    session_start();

    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if($_SESSION['usuario_tipo']=='administrador' || $_SESSION['usuario_tipo']=='empresa'){
        header('Location: ../home/');
    }

    $sqlSelect = 'SELECT id FROM solicitud 
                    WHERE tipo=0 && fk_usuario=(SELECT id FROM usuario WHERE username=\''.$_SESSION['usuario'].'\') && fk_proyecto='.$_GET['id'];
    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    if($recordSet->num_rows>0){
        $mensajeError = "Este usuario ya ha solicitado unirse al proyecto";
        $_SESSION['mensaje_union'] = $mensajeError;
        $_SESSION['mensaje_unionF'] = '1';
        sleep(2);
        header( "Location: ../projects/proyecto.php?id=".$_GET['id'], true, 303);
        exit();
    }
    
    $sqlSelect = 'SELECT count(a.id) as numero_solicitudes, c.vacantes FROM solicitud a, alumno b, proyecto c 
                    WHERE a.tipo=0 AND a.estado=1 AND a.fk_usuario=b.fk_usuario AND c.id=a.fk_proyecto AND a.fk_proyecto='.$_GET['id'];

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
        $_SESSION['mensaje_error'] = 'El Proyecto no existe';
        $_SESSION['mensaje_errorF'] = '1';
        header("Location: ../home", true, 303);
    }

    if($_SESSION['usuario_tipo']=='alumno' && $num_Solicitudes==$num_Vacantes){
        $mensajeError = "El proyecto ya no tiene vacantes";
        $_SESSION['mensaje_union'] = $mensajeError;
        $_SESSION['mensaje_unionF'] = '1';
        sleep(2);
        header( "Location: ../projects/proyecto.php?id=".$_GET['id'], true, 303);
        exit();
    }

    $sqlInsert = 'INSERT INTO solicitud(id, tipo, estado, fk_usuario, fk_proyecto) 
                    VALUES(NULL,0,0,(SELECT id FROM usuario WHERE username=\''.$_SESSION['usuario'].'\'),'.$_GET['id'].')';
    if($conn->query($sqlInsert)==FALSE){
        $mensajeError = "Error al unirse al proyecto";
        $_SESSION['mensaje_union'] = $mensajeError;
        $_SESSION['mensaje_unionF'] = '1';
        sleep(2);
        header( "Location: ../projects/proyecto.php?id=".$_GET['id'], true, 303);
        exit();
    } else {
        $mensajeExito = "Solicitud creada. El administrador confirmará su petición.";
        $_SESSION['mensaje_union'] = $mensajeExito;
        $_SESSION['mensaje_unionF'] = '1';
        sleep(2);
        header( "Location: ../projects/proyecto.php?id=".$_GET['id'], true, 303);
        exit();
    }