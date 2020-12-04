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
                    <h3 class="text-center">Registro de Profesores</h3>
                    <a href="../login/" class="btn btn-warning btn-sm float-right">Regresar</a>
                </div>
                <!-- Rutina de despliegue de errores --> 
                <?php if(isset($mensajeError)){ ?>
                        <div class="alert alert-danger">
                            <?php echo $mensajeError; ?>
                        </div>
                <?php } ?>
                <div class="card-body bg-primary text-white mb-2 border">
                    <form action="registroProfesor.php" method="post">

                        <div class="form-group">
                            <label for="usuario_Profesor">Usuario</label>
                            <input type="text" class="form-control" 
                            id="usuario_Profesor" name="usuario_Profesor" required
                            placeholder="Escriba su nombre de usuario"
                            title="Mín. 4 caracteres, Máx. 12"
                            value="<?php echo $usuario_Profesor; ?>"
                            pattern="^[A-Za-z0-9-_]{4,12}$">
                        </div>

                        <div class="form-group">
                            <label for="password_Profesor">Password de Acceso Personal</label>
                            <input type="password" class="form-control"
                            id="password_Profesor" name="password_Profesor" required 
                            placeholder="Escriba una contraseña de acceso personal"
                            title="Debe de contener mín. 6 caracteres y una minúscula, una mayúscula y un número"
                            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9-_]{6,12}$">
                        </div>

                        <div class="form-group">
                            <label for="rfc_Profesor">RFC</label> 
                            <input type="text" class="form-control"
                            id="rfc_Profesor" name="rfc_Profesor" required 
                            placeholder="Escriba su RFC. Formato: 3/4 mayúsculas, 6 números, 3 mayúsculas/números."
                            title="Ej: ABCD010203Z9W"
                            value="<?php echo $rfc_Profesor; ?>"
                            pattern = "^[A-Z]{3,4}[0-9]{6}[A-Z0-9]{3}$">
                        </div>

                        <div class="form-group">
                            <label for="nombre_Profesor">Nombre completo</label>
                            <input type="text" class="form-control"
                            id="nombre_Profesor" name="nombre_Profesor" required 
                            placeholder="Escriba su nombre completo"
                            title="Nombre completo"
                            value="<?php echo $nombre_Profesor; ?>"
                            pattern = "^[A-Za-zÑñÁáÉéÍíÓóÚú ]{10,64}$">
                        </div>
                        
                        <div class="form-group">
                            <label for="email_Profesor">Email de contacto personal</label>
                            <input type="email" class="form-control"
                            id="email_Profesor" name="email_Profesor" required 
                            placeholder="Escriba un Email de contacto personal"
                            value="<?php echo $email_Profesor; ?>"
                            title="Ej: correo@itver.edu.mx">
                        </div>

                        <div class="form-group">
                            <label for="telefono_Profesor">Telefono de contacto personal</label>
                            <input type="text" class="form-control"
                            id="telefono_Profesor" name="telefono_Profesor" required 
                            placeholder="Escriba un teléfono de contacto personal"
                            title="10 dígitos"
                            value="<?php echo $telefono_Profesor; ?>"
                            pattern = "^[0-9]{10}$">
                        </div>

                        <div class="form-group">
                            <label for="carrera_Profesor">Carrera</label>
                            <select id="carrera_Profesor" name="carrera_Profesor" class="form-control">
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