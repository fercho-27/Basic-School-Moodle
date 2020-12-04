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
                    <h3 class="text-center">Registro de Empresas</h3>
                    <a href="../login/" class="btn btn-warning btn-sm float-right">Regresar</a>
                </div>
                <!-- Rutina de despliegue de errores --> 
                <?php if(isset($mensajeError)){ ?>
                        <div class="alert alert-danger">
                            <?php echo $mensajeError; ?>
                        </div>
                <?php } ?>
                <div class="card-body bg-primary text-white mb-2 border">
                    <form action="registroEmpresa.php" method="post">

                        <div class="form-group">
                            <label for="usuario_Empresa">Usuario</label>
                            <input type="text" class="form-control" 
                            id="usuario_Empresa" name="usuario_Empresa" required
                            placeholder="Escriba su nombre de usuario"
                            title="Mín. 4 caracteres, Máx. 12"
                            value="<?php echo $usuario_Empresa; ?>"
                            pattern="^[A-Za-z0-9-_]{4,12}$">
                        </div>

                        <div class="form-group">
                            <label for="password_Empresa">Password de Acceso Personal</label>
                            <input type="password" class="form-control"
                            id="password_Empresa" name="password_Empresa" required 
                            placeholder="Escriba una contraseña de acceso personal"
                            title="Debe de contener mín. 6 caracteres y una minúscula, una mayúscula y un número"
                            pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9-_]{6,12}$">
                        </div>

                        <div class="form-group">
                            <label for="rfc_Empresa">RFC</label> 
                            <input type="text" class="form-control"
                            id="rfc_Empresa" name="rfc_Empresa" required 
                            placeholder="Escriba el RFC de la Empresa. Formato: 3 mayúsculas, 6 números, 3 mayúsculas/números."
                            title="Ej: ABC010203Z9W"
                            value="<?php echo $rfc_Empresa; ?>"
                            pattern = "^[A-Z]{3}[0-9]{6}[A-Z0-9]{3}$">
                        </div>

                        <div class="form-group">
                            <label for="nombre_Empresa">Nombre de la Empresa</label>
                            <input type="text" class="form-control"
                            id="nombre_Empresa" name="nombre_Empresa" required 
                            placeholder="Escriba el nombre de la empresa"
                            title="Nombre de la empresa"
                            value="<?php echo $nombre_Empresa; ?>"
                            pattern = "^[A-Za-z0-9-_.ÑñÁáÉéÍíÓóÚú ]{5,64}$">
                        </div>

                        <div class="form-group">
                            <label for="ubicacion_Empresa">Ubicacion de la Empresa</label>
                            <input type="text" class="form-control"
                            id="ubicacion_Empresa" name="ubicacion_Empresa" required 
                            placeholder="Escriba la dirección de la Empresa"
                            title="Dirección de la Empresa"
                            value="<?php echo $ubicacion_Empresa; ?>"
                            pattern = "^[A-Za-z0-9-_.#ÑñÁáÉéÍíÓóÚú ]{15,128}$">
                        </div>
                        
                        <div class="form-group">
                            <label for="email_Empresa">Email correspondiente de la Empresa</label>
                            <input type="email" class="form-control"
                            id="email_Empresa" name="email_Empresa" required 
                            placeholder="Escriba un Email correspondiente de la Empresa"
                            value="<?php echo $email_Empresa; ?>"
                            title="Ej: correo@itver.edu.mx">
                        </div>

                        <div class="form-group">
                            <label for="telefono_Empresa">Telefono de la Empresa</label>
                            <input type="text" class="form-control"
                            id="telefono_Empresa" name="telefono_Empresa" required 
                            placeholder="Escriba el teléfono de la Empresa"
                            title="10 dígitos"
                            value="<?php echo $telefono_Empresa; ?>"
                            pattern = "^[0-9]{10}$">
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