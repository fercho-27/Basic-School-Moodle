<?php
    session_start();
    function valorCarrera($carrera){
        if($carrera==1) return "Lic. en Administración";
        if($carrera==2) return "Ing. Electrónica";
        if($carrera==3) return "Ing. Eléctrica";
        if($carrera==4) return "Ing. Industrial";
        if($carrera==5) return "Ing. Mecánica";
        if($carrera==6) return "Ing. Bioquímica";
        if($carrera==7) return "Ing. Mecatrónica";
        if($carrera==8) return "Ing. Química";
        if($carrera==9) return "Ing. en Sistemas Computacionales";
        if($carrera==10) return "Ing. en Energías Renovables";
        if($carrera==11) return "Ing. en Gestión Empresarial";
        return "error";
    }
    require_once '../includes/header.php';
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if(!$_SESSION['usuario_tipo']=='administrador'){
        header('Location: ../home/');
    }

    $id_Usuario = $_GET['id'];
    $tipo_Usuario = $_GET['tipo'];
    if($tipo_Usuario==1){ //empresas
        $sqlSelect = 'SELECT a.username, a.correo, a.estado, b.nombre, b.ubicacion, b.rfc, b.telefono 
                    FROM usuario a, empresa b 
                    WHERE b.fk_usuario = a.id AND a.id='.$id_Usuario;
        $stmt = $conn->prepare($sqlSelect);
        $stmt->execute();
        $recordSet = $stmt->get_result();
        if($recordSet->num_rows>0){
            while($row = $recordSet->fetch_assoc()){
                $nombre_Usuario = $row['username'];
                $correo_Usuario = $row['correo'];
                $estado_Usuario = $row['estado'];
                $rol_Usuario = 'Empresa';
                $nombre_Empresa = $row['nombre'];
                $ubicacion_Empresa = $row['ubicacion'];
                $rfc_Empresa = $row['rfc'];
                $telefono_Empresa = $row['telefono'];
            }
        } else {
            #No hay Usuario Empresa
            $_SESSION['mensaje_error'] = 'La Empresa no existe';
            $_SESSION['mensaje_errorF'] = '1';
            header("Location: ../home", true, 303);
        }
    } else if($tipo_Usuario==2){ //alumnos
        $sqlSelect = 'SELECT a.username, a.correo, a.estado, b.nombre, b.carrera, b.semestre, b.telefono, b.num_control 
                    FROM usuario a, alumno b 
                    WHERE b.fk_usuario = a.id AND a.id='.$id_Usuario;
        $stmt = $conn->prepare($sqlSelect);
        $stmt->execute();
        $recordSet = $stmt->get_result();
        if($recordSet->num_rows>0){
            while($row = $recordSet->fetch_assoc()){
                $nombre_Usuario = $row['username'];
                $correo_Usuario = $row['correo'];
                $estado_Usuario = $row['estado']==0?'En revisión':($row['estado']==1?'Aceptado':'Rechazado');
                $rol_Usuario = 'Alumno';
                $nombre_Alumno = $row['nombre'];
                $carrera_Alumno = valorCarrera($row['carrera']);
                $semestre_Alumno = $row['semestre'];
                $telefono_Alumno = $row['telefono'];
                $numControl_Alumno = $row['num_control'];
            }
        } else {
            #No hay Usuario Alumno
            $_SESSION['mensaje_error'] = 'El Alumno no existe';
            $_SESSION['mensaje_errorF'] = '1';
            header("Location: ../home", true, 303);
        }
    } else if($tipo_Usuario==3){ //profesores
        $sqlSelect = 'SELECT a.username, a.correo, a.estado, b.nombre, b.carrera, b.telefono, b.rfc 
                    FROM usuario a, profesor b 
                    WHERE b.fk_usuario = a.id AND a.id='.$id_Usuario;
        $stmt = $conn->prepare($sqlSelect);
        $stmt->execute();
        $recordSet = $stmt->get_result();
        if($recordSet->num_rows>0){
            while($row = $recordSet->fetch_assoc()){
                $nombre_Usuario = $row['username'];
                $correo_Usuario = $row['correo'];
                $estado_Usuario = $row['estado'];
                $rol_Usuario = 'Profesor';
                $nombre_Profesor = $row['nombre'];
                $carrera_Profesor = valorCarrera($row['carrera']);
                $telefono_Profesor = $row['telefono'];
                $rfc_Profesor = $row['rfc'];
            }
        } else {
            #No hay Usuario Profesor
            $_SESSION['mensaje_error'] = 'El Profesor no existe';
            $_SESSION['mensaje_errorF'] = '1';
            header("Location: ../home", true, 303);
        }
    } else {
        #Admin o no existe Usuario
        $_SESSION['mensaje_error'] = 'El Usuario no existe';
        $_SESSION['mensaje_errorF'] = '1';
        header("Location: ../home", true, 303);
    }

    require_once 'usuarioForma.php';
    require_once '../includes/footer.php';