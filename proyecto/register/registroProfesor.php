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

    function valorCarrera($carrera){
        if($carrera=="administracion") return 1;
        if($carrera=="electronica") return 2;
        if($carrera=="electrica") return 3;
        if($carrera=="industrial") return 4;
        if($carrera=="mecanica") return 5;
        if($carrera=="bioquimica") return 6;
        if($carrera=="mecatronica") return 7;
        if($carrera=="quimica") return 8;
        if($carrera=="sistemas") return 9;
        if($carrera=="renovables") return 10;
        if($carrera=="gestion") return 11;
        return -1;
    }

    require_once '../includes/header.php';
    require_once '../bd/conexion.php';

    if(isset($_SESSION['login'])){
        if($_SESSION['login']=='1'){
            header('Location: ../home');
        }
    }

    if(isset($_POST['btnRegistrar'])){

        $usuario_Profesor = $_POST['usuario_Profesor'];
        $password_Profesor = $_POST['password_Profesor'];
        $rfc_Profesor = $_POST['rfc_Profesor'];
        $nombre_Profesor = $_POST['nombre_Profesor'];
        $email_Profesor = $_POST['email_Profesor'];
        $telefono_Profesor = $_POST['telefono_Profesor'];
        $carrera_Profesor = $_POST['carrera_Profesor'];
        $hayErrores = FALSE;
        
        $expresion = "/^[A-Za-z0-9-_]{4,12}$/";
        if(verificarCampo($usuario_Profesor,$expresion)){
            $expresion = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9-_]{6,12}$/";
            if(verificarCampo($password_Profesor,$expresion)){
                $expresion = "/^[A-Z]{3,4}[0-9]{6}[A-Z0-9]{3}$/";
                if(verificarCampo($rfc_Profesor,$expresion)){
                    $expresion = "/^[A-Za-zÑñÁáÉéÍíÓóÚú ]{10,64}$/iu";
                    if(verificarCampo($nombre_Profesor,$expresion)){
                        if(!empty($email_Profesor and filter_var($email_Profesor, FILTER_VALIDATE_EMAIL))){
                            $expresion = "/^[0-9]{10}$/";
                            if(verificarCampo($telefono_Profesor,$expresion)){
                                $hayErrores = FALSE;
                            } else{
                                $hayErrores = TRUE;
                            }
                        } else{
                            $hayErrores = TRUE;
                        }
                    } else{
                        $hayErrores = TRUE;
                    }
                } else{
                    $hayErrores = TRUE;
                }
            } else{
                $hayErrores = TRUE;
            }
        } else{
            $hayErrores = TRUE;
        }
        if(!$hayErrores){
            $sqlInsert = 'INSERT INTO usuario(id, username, password, correo, tipo, estado) 
                            VALUES(NULL,\''.$usuario_Profesor.'\',\''.$password_Profesor.'\',\''.$email_Profesor.'\', 3,0)';
            if($conn->query($sqlInsert)==FALSE){
                $mensajeError = "Inconsistencias en la insercción de usuario a la base de datos.";
            } else {
                $sqlInsert = 'INSERT INTO profesor(id, nombre, carrera, telefono, rfc, fk_usuario) 
                                VALUES(NULL,\''.$nombre_Profesor.'\','.valorCarrera($carrera_Profesor).',\''.$telefono_Profesor.'\',\''.$rfc_Profesor.'\',
                                    (SELECT id from usuario WHERE username = \''.$usuario_Profesor.'\'))';
                if($conn->query($sqlInsert)==FALSE){
                    $mensajeError = "Inconsistencias en la insercción de alumno a la base de datos.";
                    $sqlDelete = 'DELETE FROM usuario WHERE usuario.username = \''.$usuario_Profesor.'\'';
                    $conn->query($sqlDelete);
                } else{
                    $usuario_Profesor = '';
                    $password_Profesor = '';
                    $rfc_Profesor = '';
                    $nombre_Profesor = '';
                    $email_Profesor = '';
                    $telefono_Profesor = '';
                    $carrera_Profesor = '';
                    $mensajeExito = "Profesor registrado correctamente.";
                    $_SESSION['mensaje_registro'] = $mensajeExito;
                    $_SESSION['mensaje_registroF'] = '1';
                    sleep(2);
                    header( "Location: ../login", true, 303 );
                    exit();
                }
            }
        }
        else{
            $mensajeError = "Los datos introducidos son inconsistentes. Verifiquelos por favor.";
        }
    } else {
        $usuario_Profesor = '';
        $password_Profesor = '';
        $rfc_Profesor = '';
        $nombre_Profesor = '';
        $email_Profesor = '';
        $telefono_Profesor = '';
        $carrera_Profesor = '';
    }

    require_once 'registroProfesorForma.php';
    require_once '../includes/footer.php';