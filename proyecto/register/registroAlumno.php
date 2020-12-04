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

        $usuario_Alumno = $_POST['usuario_Alumno'];
        $password_Alumno = $_POST['password_Alumno'];
        $numControl_Alumno = $_POST['numControl_Alumno'];
        $nombre_Alumno = $_POST['nombre_Alumno'];
        $email_Alumno = $_POST['email_Alumno'];
        $telefono_Alumno = $_POST['telefono_Alumno'];
        $semestre_Alumno = $_POST['semestre_Alumno'];
        $carrera_Alumno = $_POST['carrera_Alumno'];
        $hayErrores = FALSE;
        
        $expresion = "/^[A-Za-z0-9-_]{4,12}$/";
        if(verificarCampo($usuario_Alumno,$expresion)){
            $expresion = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9-_]{6,12}$/";
            if(verificarCampo($password_Alumno,$expresion)){
                $expresion = "/^[E][0-9]{8}$/";
                if(verificarCampo($numControl_Alumno,$expresion)){
                    $expresion = "/^[A-Za-zÑñÁáÉéÍíÓóÚú ]{10,64}$/iu";
                    if(verificarCampo($nombre_Alumno,$expresion)){
                        if(!empty($email_Alumno and filter_var($email_Alumno, FILTER_VALIDATE_EMAIL))){
                            $expresion = "/^[0-9]{10}$/";
                            if(verificarCampo($telefono_Alumno,$expresion)){
                                if($semestre_Alumno>=1 && $semestre_Alumno<=20){
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
        } else{
            $hayErrores = TRUE;
        }
        if(!$hayErrores){
            $sqlInsert = 'INSERT INTO usuario(id, username, password, correo, tipo, estado)
                            VALUES(NULL,\''.$usuario_Alumno.'\',\''.$password_Alumno.'\',\''.$email_Alumno.'\',2,0)';
            if($conn->query($sqlInsert)==FALSE){
                $mensajeError = "Inconsistencias en la insercción de usuario a la base de datos.";
            } else {
                $sqlInsert = 'INSERT INTO alumno(id, nombre, carrera, telefono, semestre, num_control, fk_usuario) 
                                VALUES(NULL,\''.$nombre_Alumno.'\','.valorCarrera($carrera_Alumno).',\''.$telefono_Alumno.'\',\''.$semestre_Alumno.'\',\''.$numControl_Alumno.'\',
                                    (SELECT id from usuario WHERE username = \''.$usuario_Alumno.'\'))';
                if($conn->query($sqlInsert)==FALSE){
                    $mensajeError = "Inconsistencias en la insercción de alumno a la base de datos.";
                    $sqlDelete = 'DELETE FROM usuario WHERE usuario.username = \''.$usuario_Alumno.'\'';
                    $conn->query($sqlDelete);
                } else{
                    $usuario_Alumno = '';
                    $password_Alumno = '';
                    $numControl_Alumno = '';
                    $nombre_Alumno = '';
                    $email_Alumno = '';
                    $telefono_Alumno = '';
                    $semestre_Alumno = 1;
                    $carrera_Alumno = '';
                    $mensajeExito = "Alumno registrado correctamente.";
                    $_SESSION['mensaje_registro'] = $mensajeExito;
                    $_SESSION['mensaje_registroF'] = '1';
                    sleep(2);
                    header( "Location: ../login", true, 303 );
                    exit();
                }
            }
        }else{
            $mensajeError = "Los datos introducidos son inconsistentes. Verifiquelos por favor.";
        }
    } else {
        $usuario_Alumno = '';
        $password_Alumno = '';
        $numControl_Alumno = '';
        $nombre_Alumno = '';
        $email_Alumno = '';
        $telefono_Alumno = '';
        $semestre_Alumno = 1;
        $carrera_Alumno = '';
    }

    require_once 'registroAlumnoForma.php';
    require_once '../includes/footer.php';