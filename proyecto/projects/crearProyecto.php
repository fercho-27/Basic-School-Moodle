<?php
    session_start();
    function limpiarCampo($valor){
        $valor = strip_tags($valor);
        $valor = htmlspecialchars($valor);
        $valor = htmlentities($valor);
        return $valor;
    }

    function verificarCampo($campo){
        $campo = limpiarCampo($campo);
        $campo = html_entity_decode($campo, ENT_QUOTES, "UTF-8");
        $expresion = "/^[A-Za-z0-9.,*-_#@ÑñÁáÉéÍíÓóÚú ]{1,512}$/iu";
        if(!empty($campo) and preg_match($expresion, $campo)) return TRUE;
        return FALSE;
    }

    require_once '../includes/header.php';
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if($_SESSION['usuario_tipo']=='alumno' || $_SESSION['usuario_tipo']=='profesor'){
        header('Location: ../home/');
    }
    
    if(isset($_POST['btnRegistrar'])){

        $nombre_Proyecto = $_POST['nombre_Proyecto'];
        $tipo_Proyecto = $_POST['tipo_Proyecto'];
        $vacantes_Proyecto = $_POST['vacantes_Proyecto'];
        $duracion_Proyecto = $_POST['duracion_Proyecto'];
        $requisitos_Proyecto = $_POST['requisitos_Proyecto'];
        $descripcion_Proyecto = $_POST['descripcion_Proyecto'];
        $hayErrores = FALSE;
        
        if(verificarCampo($nombre_Proyecto) && verificarCampo($tipo_Proyecto) && verificarCampo($requisitos_Proyecto) && verificarCampo($descripcion_Proyecto)){
            if($vacantes_Proyecto>=1 && $vacantes_Proyecto<=99 && $duracion_Proyecto>=1 && $duracion_Proyecto<=99){
                $hayErrores = FALSE;
            } else {
                $hayErrores = TRUE;
            }
        } else{
            $hayErrores = TRUE;
        }
        
        if(!$hayErrores){
            $sqlInsert = 'INSERT INTO proyecto(id, nombre, tipo, vacantes, duracion, requisitos, descripcion, fk_empresa) 
                            VALUES(NULL,\''.$nombre_Proyecto.'\',\''.$tipo_Proyecto.'\','.$vacantes_Proyecto.','.$duracion_Proyecto.',\''.$requisitos_Proyecto.'\',\''.$descripcion_Proyecto.'\',';
            if($_SESSION['usuario_tipo']=='administrador'){
                $sqlInsert.='0)';
            } else {
                $sqlInsert.= '(SELECT a.id FROM empresa a, usuario b WHERE b.username=\''.$_SESSION['usuario'].'\' AND b.id=a.fk_usuario))';
            }
            if($conn->query($sqlInsert)==FALSE){
                $mensajeError = "Inconsistencias en la insercción de proyecto a la base de datos.";
            } else {
                if($_SESSION['usuario_tipo']=='administrador'){
                    $usuario_Proyecto = '';
                    $password_Proyecto = '';
                    $numControl_Proyecto = '';
                    $nombre_Proyecto = '';
                    $email_Proyecto = '';
                    $telefono_Proyecto = '';
                    $semestre_Proyecto = '';
                    $carrera_Proyecto = '';
                    $mensajeExito = "Proyecto creado correctamente.";
                    $_SESSION['mensaje_creacion'] = $mensajeExito;
                    $_SESSION['mensaje_creacionF'] = '1';
                    sleep(2);
                    header( "Location: proyectos.php", true, 303 );
                    exit();
                }
                $sqlInsert = 'INSERT INTO solicitud(id, tipo, estado, fk_usuario, fk_proyecto) 
                                VALUES(NULL,1,0,(SELECT id FROM usuario WHERE username=\''.$_SESSION['usuario'].'\'),
                                    (SELECT id FROM proyecto WHERE fk_empresa=(SELECT id FROM empresa WHERE nombre=\''.$_SESSION['nombre_usuario'].'\')))';
                if($conn->query($sqlInsert)==FALSE){
                    $mensajeError = "Inconsistencias en la insercción de solicitud a la base de datos.";
                    $sqlDelete = 'DELETE FROM proyecto WHERE proyecto.fk_empresa = (SELECT id FROM empresa WHERE nombre=\''.$_SESSION['nombre_usuario'].'\')';
                    $conn->query($sqlDelete);
                } else{
                    $usuario_Proyecto = '';
                    $password_Proyecto = '';
                    $numControl_Proyecto = '';
                    $nombre_Proyecto = '';
                    $email_Proyecto = '';
                    $telefono_Proyecto = '';
                    $semestre_Proyecto = '';
                    $carrera_Proyecto = '';
                    $mensajeExito = "Proyecto creado correctamente.";
                    $_SESSION['mensaje_creacion'] = $mensajeExito;
                    $_SESSION['mensaje_creacionF'] = '1';
                    sleep(2);
                    header( "Location: proyectos.php", true, 303 );
                    exit();
                }
            }
        }
        else{
            $mensajeError = "Los datos introducidos son inconsistentes. Verifiquelos por favor.";
        }
    } else {
        $nombre_Proyecto = '';
        $tipo_Proyecto = '';
        $vacantes_Proyecto = 1;
        $duracion_Proyecto = 1;
        $requisitos_Proyecto = '';
        $descripcion_Proyecto = '';
    }

    require_once 'crearProyectoForma.php';
    require_once '../includes/footer.php';