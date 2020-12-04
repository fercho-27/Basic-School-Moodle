<?php
if(!$_SESSION['login']==1){
    header('Location: ../login/');
}
?>
<div class="container-fluid border bg-dark text-center text-white">
    <div class="row">
        <div class="col">
            <a href="../home" class="btn btn-primary btn-sm float-left mt-2 ml-4 mb-2"><h2>HOME</h2></a>
            <a href="logout.php" class="btn btn-danger btn-sm float-right mt-2 mr-4 mb-2"><h2>LOGOUT</h2></a>
        </div>
    </div>
</div>

<div class="imagenfondo-login">

    <div class="container pt-2 mb-5 pb-5">
        <!-- Rutina de despliegue de exito --> 
        <?php if(isset($mensajeExito)){ ?>
                <div class="alert alert-success pt-2 mb-2 text-center text-dark">
                    <h4> <?php echo $mensajeExito; ?> </h4>
                </div>
        <?php } ?>
        <!-- Rutina de despliegue de errores --> 
        <?php if(isset($mensajeError)){ ?>
                <div class="alert alert-warning pt-2 mb-2 text-center text-dark">
                    <h4> <?php echo $mensajeError; ?> </h4>
                </div>
        <?php } ?>
        <div class="row justify-content-center pt-4 pb-4">
            <div class="col-4 border bg-dark text-center text-white pt-2 mb-5">
                <h5 class="text-info">HOME</h5>
                <hr class="separador">
                <a href="../projects/proyectos.php" class="btn btn-info btn-sm mb-3">PROYECTOS</a>
                <?php
                    if($_SESSION['usuario_tipo'] == 'administrador'){?>
                        <br>
                        <a href="../requests/solicitudes.php" class="btn btn-info btn-sm mb-3">SOLICITUDES</a>
                        <br>
                        <a href="../requests/usuarios.php" class="btn btn-info btn-sm mb-3">USUARIOS</a>
                <?php }?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center pt-4 pb-4">
            <div class="col-8 border bg-dark text-center text-white pt-2 mb-4">
                <h6>Sobre la página: </h6>
                <p>
                    Versión 0.6: Acentos y ñ agregados a los campos correspondientes. Corrección de errores.
                </p>
                <br>
                <p>
                    Versión 0.5: Atributo 'tipo' y 'estado' agregado a la tabla de usuarios en la bd. Administrador ya puede crear proyecto. El registro al sistema ya genera solicitudes para el Administrador.
                                El Administrador ya puede aceptar o rechazar solicitudes de registro al sistema. Cambios de diseño al Sistema.
                </p>
                <br>
                <p>
                    Versión 0.4: La estructura de las carpetas fue cambiada para mejor organización. Los alumnos y profesores ya pueden solicitar unirse a un proyecto.
                                Administrador ya tiene vista de solicitudes y ya puede aceptar o rechazar solicitudes. El administrador no puede crear proyecto aun.
                </p>
                <br>
                <p>
                    Versión 0.3: Vista de home, proyectos, crear proyecto, visualizar proyecto y agregar comentarios funcionando para sus respectivos roles.
                                 Todavía no se realizan solicitudes, los cambios como la creación de proyectos son directos.
                </p>
                <br>
                <p>
                    Versión 0.2: Vista de registrar alumno, profesor y empresa funcionando. Primera versión de la validación en backend y frontend. BD sin validar.
                </p>
                <br>
                <p>
                    Versión 0.1: Vista de Login funcionando y Vista de Registro del alumno sin funcionar.
                </p>
                <br>
            </div>
        </div>
    </div>

</div>