<div class="container-fluid border bg-dark text-center text-white">
    <div class="row">
        <div class="col">
            <h2>PROYECTO RESIDENCIAS</h2>
        </div>
    </div>
</div>
<div class="imagenfondo-login">
    <div class="container pt-2">
        <!-- Rutina de despliegue de exito --> 
        <?php if(isset($mensajeExito)){ ?>
                <div class="alert alert-success pt-2 mb-2 text-center text-dark">
                    <h4> <?php echo $mensajeExito; ?> </h4>
                </div>
        <?php } ?>
        <div class="row justify-content-center pt-4 pb-4">
            <div class="col-4 border bg-dark text-center text-white pt-2">
                <h5 class="text-info">LOGIN</h5>
                <hr class="separador">

                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label for="Usuario">Usuario</label>
                        <input type="text" class="form-control"
                        id="usuario" name="usuario" required 
                        placeholder="Escriba su usuario"
                        title="Escriba su usuario"
                        pattern="^[A-Za-z0-9-_]{4,12}$">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control"
                        id="password" name="password" required 
                        placeholder="Escriba su contraseña"
                        title="Escriba su contraseña"
                        pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9-_]{6,12}$">
                    </div>

                    <input type="radio" id="alumno" name="tipo" value="alumno" required>
                    <label for="alumno">Alumno</label><br>
                    <input type="radio" id="profesor" name="tipo" value="profesor">
                    <label for="profesor">Profesor</label><br>
                    <input type="radio" id="empresa" name="tipo" value="empresa">
                    <label for="empresa">Empresa</label><br>
                    <input type="radio" id="admin" name="tipo" value="administrador">
                    <label for="admin">Administrador</label>

                    <div class="text-center">
                        <input type="submit" name="btnEntrar" 
                        class="btn btn-info"
                        value="ENTRAR">
                    </div>
                    <!-- Rutina de despliegue de errores --> 
                    <br>
                    <?php
                        if(isset($mensajeError)){
                    ?>
                        <div class="alert alert-danger">
                            <?php echo $mensajeError; ?>
                        </div>
                    <?php
                        }
                    ?>

                </form>

                <hr class="separador">
                <a href="../register/registroAlumno.php">Crear una cuenta de alumno</a><br>
                <a href="../register/registroProfesor.php">Crear una cuenta de profesor</a><br>
                <a href="../register/registroEmpresa.php">Crear una cuenta de empresa</a>
                <br><br>

                
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