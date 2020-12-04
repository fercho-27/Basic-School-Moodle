<?php if(isset($_SESSION['login'])){
        if($_SESSION['login']=='1'){
            header('Location: ../home');
        }
    } ?>
<div class="imagenfondo-registro">
    <div class="container pt-3 pb-3"> 
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 card bg-dark">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center">Registro de Alumnos</h3>
                    <a href="../login/" class="btn btn-warning btn-sm float-right">Regresar</a>
                </div>
                <!-- Rutina de despliegue de errores --> 
                <?php if(isset($mensajeError)){ ?>
                        <div class="alert alert-danger">
                            <?php echo $mensajeError; ?>
                        </div>
                <?php } ?>
                <div class="card-body bg-primary text-white mb-2 border">
                    <form action="registroAlumno.php" method="post">

                        <div class="form-group">
                            <label for="usuario_Alumno">Usuario</label>
                            <input type="text" class="form-control" 
                            id="usuario_Alumno" name="usuario_Alumno" required
                            placeholder="Escriba su nombre de usuario"
                            title="Mín. 4 caracteres, Máx. 12"
                            value="<?php echo $usuario_Alumno; ?>"
                            pattern="^[A-Za-z0-9-_]{4,12}$">
                        </div>

                        <div class="form-group">
                            <label for="password_Alumno">Password de Acceso Personal</label>
                            <input type="password" class="form-control"
                            id="password_Alumno" name="password_Alumno" required 
                            placeholder="Escriba una contraseña de acceso personal"
                            title="Debe de contener mín. 6 caracteres y una minúscula, una mayúscula y un número"
                            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9-_]{6,12}$">
                        </div>

                        <div class="form-group">
                            <label for="numControl_Alumno">Número de Control</label> 
                            <input type="text" class="form-control"
                            id="numControl_Alumno" name="numControl_Alumno" required 
                            placeholder="Escriba su Número de Control"
                            title="Ej: E12345678"
                            value="<?php echo $numControl_Alumno; ?>"
                            pattern = "^[E][0-9]{8}$">
                        </div>

                        <div class="form-group">
                            <label for="nombre_Alumno">Nombre completo</label>
                            <input type="text" class="form-control"
                            id="nombre_Alumno" name="nombre_Alumno" required 
                            placeholder="Escriba su nombre completo"
                            title="Nombre completo"
                            value="<?php echo $nombre_Alumno; ?>"
                            pattern = "^[A-Za-zÑñÁáÉéÍíÓóÚú ]{10,64}$">
                        </div>
                        
                        <div class="form-group">
                            <label for="email_Alumno">Email de contacto personal</label>
                            <input type="email" class="form-control"
                            id="email_Alumno" name="email_Alumno" required 
                            placeholder="Escriba un Email de contacto personal"
                            value="<?php echo $email_Alumno; ?>"
                            title="Ej: correo@itver.edu.mx">
                        </div>

                        <div class="form-group">
                            <label for="telefono_Alumno">Telefono de contacto personal</label>
                            <input type="text" class="form-control"
                            id="telefono_Alumno" name="telefono_Alumno" required 
                            placeholder="Escriba un teléfono de contacto personal"
                            title="10 dígitos"
                            value="<?php echo $telefono_Alumno; ?>"
                            pattern = "^[0-9]{10}$">
                        </div>

                        <div class="form-group">
                            <label for="semestre_Alumno">Semestre</label>
                            <input type="number" class="form-control"
                            id="semestre_Alumno" name="semestre_Alumno" required 
                            placeholder="Escriba su número de semestre"
                            title="Escriba su número de semestre"
                            value="<?php echo $semestre_Alumno; ?>"
                            min="1" max="20">
                        </div>

                        <div class="form-group">
                            <label for="carrera_Alumno">Carrera</label>
                            <select id="carrera_Alumno" name="carrera_Alumno" class="form-control">
                                <option value="administracion">Lic. en Administración</option>
                                <option value="electronica">Ing. Electrónica</option>
                                <option value="electrica">Ing. Eléctrica</option> 
                                <option value="industrial">Ing. Industrial</option>
                                <option value="mecanica">Ing. Mecánica</option>
                                <option value="bioquimica">Ing. Bioquímica</option>
                                <option value="mecatronica">Ing. Mecatrónica</option>
                                <option value="quimica">Ing. Química</option>
                                <option value="sistemas" selected>Ing. en Sistemas Computacionales</option>                         
                                <option value="renovables">Ing. en Energías Renovables</option>
                                <option value="gestion">Ing. en Gestión Empresarial</option>
                            </select> 
                        </div>

                        <div class="text-right">
                            <input type="submit" name="btnRegistrar" 
                            class="btn btn-success"
                            value="SOLICITAR REGISTRO">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>