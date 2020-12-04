<?php
    session_start();
    function limpiarCampo($valor){
        $valor = strip_tags($valor);
        $valor = htmlspecialchars($valor);
        $valor = htmlentities($valor);
        return $valor;
    }

    function verificarCampo($campo, $regExp){
        $campo = limpiarCampo($campo);
        $campo = html_entity_decode($campo, ENT_QUOTES, "UTF-8");
        if(!empty($campo) and preg_match($regExp, $campo)) return TRUE;
        return FALSE;
    }
    require_once '../includes/header.php';
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if(!isset($_GET['id'])){
        header('Location: ../home/');
    }

    if(isset($_SESSION['mensaje_comentario']) && isset($_SESSION['mensaje_comentarioF']) && $_SESSION['mensaje_comentarioF']=='1'){
        $mensajeExito = $_SESSION['mensaje_comentario'];
        $_SESSION['mensaje_comentarioF'] = '0';
    }

    if(isset($_SESSION['mensaje_union']) && isset($_SESSION['mensaje_unionF']) && $_SESSION['mensaje_unionF']=='1'){
        $mensajeInfo = $_SESSION['mensaje_union'];
        $_SESSION['mensaje_unionF'] = '0';
    }

    $sqlSelect = 'SELECT estado FROM solicitud WHERE tipo=1 AND fk_proyecto = '.$_GET['id'];
    $estado=1;
    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    if($recordSet->num_rows>0){
        while($row = $recordSet->fetch_assoc()){
            $estado=$row['estado'];
        }       
    }
    if($estado!=1){
        #Proyecto no ha sido aceptado
        $_SESSION['mensaje_error'] = 'El Proyecto no existe';
        $_SESSION['mensaje_errorF'] = '1';
        header("Location: ../home", true, 303);    
    }

    $sqlSelect = 'SELECT a.id as id_proyecto, a.nombre, a.tipo, a.vacantes, a.duracion, a.requisitos, a.descripcion, 
                        b.id as id_empresa, b.nombre as nombre_empresa, b.ubicacion, b.telefono 
                    FROM proyecto a, empresa b WHERE a.id = '.$_GET['id'].' AND a.fk_empresa = b.id';

    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    if($recordSet->num_rows>0){
        while($row = $recordSet->fetch_assoc()){
            $id_Proyecto = $row['id_proyecto'];
            $nombre_Proyecto = $row['nombre'];
            $tipo_Proyecto = $row['tipo'];
            $vacantes_Proyecto = $row['vacantes'];
            $duracion_Proyecto = $row['duracion'];
            $requisitos_Proyecto = $row['requisitos'];
            $descripcion_Proyecto = $row['descripcion'];
            $id_Empresa = $row['id_empresa'];
            $nombre_Empresa = $row['nombre_empresa'];
            $ubicacion_Empresa = $row['ubicacion'];
            $telefono_Empresa = $row['telefono'];
        }

        $sqlSelect = 'SELECT a.id as id_comentario, a.descripcion as descripcion_comentario
                    FROM comentario a, usuario b 
                    WHERE b.id=a.fk_usuario AND a.fk_proyecto = '.$_GET['id'];

        $stmt = $conn->prepare($sqlSelect);
        $stmt->execute();
        $recordSet = $stmt->get_result();
        if($recordSet->num_rows>0){
            $num_Comentario = 1;
            $comentarios = array();
            while($row = $recordSet->fetch_assoc()){
                $comentarios[$num_Comentario] = $row['descripcion_comentario'];
                $num_Comentario+=1;
            }
            
        }
    } else {
        #No hay Proyecto
        $_SESSION['mensaje_error'] = 'El Proyecto no existe';
        $_SESSION['mensaje_errorF'] = '1';
        header("Location: ../home", true, 303);
    }

    if(isset($_POST['btnRegistrar'])){
        $agregar_Comentario.= $_POST['agregar_Comentario'];
        $expresion = "/^[A-Za-z0-9.,*-_#@ÑñÁáÉéÍíÓóÚú ]{1,512}$/iu";
        if(verificarCampo($agregar_Comentario,$expresion)){
            date_default_timezone_set("America/Mexico_City");
            $comentario = $_SESSION['nombre_usuario'].' ('.date("d/m/Y").' - '.date("H:i").'): '.$agregar_Comentario;
            $sqlInsert = 'INSERT INTO comentario(id, descripcion, fk_usuario, fk_proyecto) 
                            VALUES(NULL,\''.$comentario.'\',(SELECT id FROM usuario WHERE username=\''.$_SESSION['usuario'].'\'),'.$_GET['id'].')';
            if($conn->query($sqlInsert)==FALSE){
                $mensajeError = "Inconsistencias en la insercción de comentario a la base de datos.";
            } else {
                $carrera_Alumno = '';
                $mensajeExito = "Comentario agregado correctamente.";
                $_SESSION['mensaje_comentario'] = $mensajeExito;
                $_SESSION['mensaje_comentarioF'] = '1';
                sleep(2);
                header( "Location: proyecto.php?id=".$_GET['id'], true, 303 );
                exit();
            }
        } else{
            $mensajeError = 'El comentario introducido tiene incosistencias. Verifiquelo por favor.';
        }

    } else{
        $agregar_Comentario = '';
    }

    require_once 'proyectoForma.php';
    require_once '../includes/footer.php';