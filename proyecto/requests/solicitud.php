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

    $id_Solicitud = $_GET['id'];
    $sqlSelect = 'SELECT a.tipo as tipo_solicitud, a.estado, a.fk_usuario as id_usuario, d.username, 
                        b.nombre as nombre_proyecto, b.tipo as tipo_proyecto, b.vacantes, b.duracion, b.requisitos, b.descripcion, 
                        c.nombre as nombre_empresa, c.ubicacion, c.telefono, c.fk_usuario
                    FROM solicitud a, proyecto b, empresa c, usuario d 
                    WHERE a.fk_usuario=d.id AND b.fk_empresa=c.id AND a.fk_proyecto = b.id AND a.id='.$id_Solicitud;

    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    if($recordSet->num_rows>0){
        while($row = $recordSet->fetch_assoc()){
            $id_Usuario = $row['id_usuario'];               //usuario que hizo la solicitud
            $nombre_Usuario = $row['username'];
            if($row['tipo_solicitud'] == '0'){
                $tipo_Solicitud = 'Unirse al proyecto';
            } else {
                $tipo_Solicitud = 'Creación de proyecto';
            }
            if($row['estado'] == '0'){
                $estado_Solicitud = 'En revisión';
            } else if($row['estado'] == '1'){
                $estado_Solicitud = 'Aceptado';
            } else {
                $estado_Solicitud = 'Rechazado';
            }
            $nombre_Proyecto = $row['nombre_proyecto'];
            $tipo_Proyecto = $row['tipo_proyecto'];
            $vacantes_Proyecto = $row['vacantes'];
            $duracion_Proyecto = $row['duracion'];
            $requisitos_Proyecto = $row['requisitos'];
            $descripcion_Proyecto = $row['descripcion'];
            $nombre_Empresa = $row['nombre_empresa'];
            $ubicacion_Empresa = $row['ubicacion'];
            $telefono_Empresa = $row['telefono'];
            $id_Empresa = $row['fk_usuario'];               //usuario empresa que hizo el proyecto
        }

        if(!($id_Empresa == $id_Usuario)){                     //implica que la solicitud la hizo un alumno o profesor
            $sqlSelect = 'SELECT a.nombre, a.carrera, a.telefono, a.semestre, a.num_control 
                            FROM alumno a WHERE a.fk_usuario='.$id_Usuario;

            $stmt = $conn->prepare($sqlSelect);
            $stmt->execute();
            $recordSet = $stmt->get_result();
            if($recordSet->num_rows>0){
                while($row = $recordSet->fetch_assoc()){
                    $nombre_Alumno = $row['nombre'];
                    $carrera_Alumno = valorCarrera($row['carrera']);
                    $telefono_Alumno = $row['telefono'];
                    $semestre_Alumno = $row['semestre'];
                    $numControl_Alumno = $row['num_control'];
                }
                
            } else {
                $sqlSelect = 'SELECT a.nombre, a.carrera, a.telefono, a.rfc 
                                FROM profesor a WHERE a.fk_usuario='.$id_Usuario;

                $stmt = $conn->prepare($sqlSelect);
                $stmt->execute();
                $recordSet = $stmt->get_result();
                if($recordSet->num_rows>0){
                    while($row = $recordSet->fetch_assoc()){
                        $nombre_Profesor = $row['nombre'];
                        $carrera_Profesor = valorCarrera($row['carrera']);
                        $telefono_Profesor = $row['telefono'];
                        $rfc_Profesor = $row['rfc'];
                    }
                    
                } else {
                    #No hay ni alumno ni Profesor
                }
            }
        }
    } else {
        #No hay Proyecto
        echo "El Proyecto no existe";
        $_SESSION['mensaje_error'] = 'El Proyecto no existe';
        $_SESSION['mensaje_errorF'] = '1';
        header("Location: ../home", true, 303);
    }

    require_once 'solicitudForma.php';
    require_once '../includes/footer.php';