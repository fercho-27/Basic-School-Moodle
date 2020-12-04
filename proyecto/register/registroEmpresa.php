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

    if(isset($_SESSION['login'])){
        if($_SESSION['login']=='1'){
            header('Location: ../home');
        }
    }

    if(isset($_POST['btnRegistrar'])){

        $usuario_Empresa = $_POST['usuario_Empresa'];
        $password_Empresa = $_POST['password_Empresa'];
        $rfc_Empresa = $_POST['rfc_Empresa'];
        $nombre_Empresa = $_POST['nombre_Empresa'];
        $ubicacion_Empresa = $_POST['ubicacion_Empresa'];
        $email_Empresa = $_POST['email_Empresa'];
        $telefono_Empresa = $_POST['telefono_Empresa'];
        $hayErrores = FALSE;
        
        $expresion = "/^[A-Za-z0-9-_]{4,12}$/";
        if(verificarCampo($usuario_Empresa,$expresion)){
            $expresion = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9-_]{6,12}$/";
            if(verificarCampo($password_Empresa,$expresion)){
                $expresion = "/^[A-Z]{3}[0-9]{6}[A-Z0-9]{3}$/";
                if(verificarCampo($rfc_Empresa,$expresion)){
                    $expresion = "/^[A-Za-z0-9-_.ÑñÁáÉéÍíÓóÚú ]{5,64}$/iu";
                    if(verificarCampo($nombre_Empresa,$expresion)){
                        if(!empty($email_Empresa and filter_var($email_Empresa, FILTER_VALIDATE_EMAIL))){
                            $expresion = "/^[0-9]{10}$/";
                            if(verificarCampo($telefono_Empresa,$expresion)){
                                $expresion = "/^[A-Za-z0-9-_.#ÑñÁáÉéÍíÓóÚú ]{15,128}$/iu";
                                if(verificarCampo($ubicacion_Empresa,$expresion)){
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
                            VALUES(NULL,\''.$usuario_Empresa.'\',\''.$password_Empresa.'\',\''.$email_Empresa.'\',1,0)';
            if($conn->query($sqlInsert)==FALSE){
                $mensajeError = "Inconsistencias en la insercción de usuario a la base de datos.";
            } else {
                $sqlInsert = 'INSERT INTO empresa(id, nombre, ubicacion, rfc, telefono, fk_usuario) 
                                VALUES(NULL,\''.$nombre_Empresa.'\',\''.$ubicacion_Empresa.'\',\''.$rfc_Empresa.'\',\''.$telefono_Empresa.'\',
                                    (SELECT id from usuario WHERE username = \''.$usuario_Empresa.'\'))';
                if($conn->query($sqlInsert)==FALSE){
                    $mensajeError = "Inconsistencias en la insercción de empresa a la base de datos.";
                    $sqlDelete = 'DELETE FROM usuario WHERE usuario.username = \''.$usuario_Empresa.'\'';
                    $conn->query($sqlDelete);
                } else{
                    $usuario_Empresa = '';
                    $password_Empresa = '';
                    $rfc_Empresa = '';
                    $nombre_Empresa = '';
                    $ubicacion_Empresa = '';
                    $email_Empresa = '';
                    $telefono_Empresa = '';
                    $mensajeExito = "Empresa registrada exitosamente.";
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
        $usuario_Empresa = '';
                    $password_Empresa = '';
                    $rfc_Empresa = '';
                    $nombre_Empresa = '';
                    $ubicacion_Empresa = '';
                    $email_Empresa = '';
                    $telefono_Empresa = '';
    }

    require_once 'registroEmpresaForma.php';
    require_once '../includes/footer.php';