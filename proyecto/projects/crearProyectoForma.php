<?php
if(!$_SESSION['login']==1){
    header('Location: ../login/');
} else if($_SESSION['usuario_tipo']=='alumno' || $_SESSION['usuario_tipo']=='profesor'){
    header('Location: ../home/');
}
?>
<div class="container-fluid border bg-dark text-center text-white">
    <div class="row">
        <div class="col">
            <a href="../home" class="btn btn-primary btn-sm float-left mt-2 ml-4 mb-2"><h2>HOME</h2></a>
            <a href="proyectos.php" class="btn btn-warning btn-sm mt-2 mb-2"><h2>Regresar</h2></a>
            <a href="../home/logout.php" class="btn btn-danger btn-sm float-right mt-2 mr-4 mb-2"><h2>LOGOUT</h2></a>
        </div>
    </div>
</div>
<div class="imagenfondo-registro">
    <div class="container pt-3 pb-3"> 
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 card bg-dark">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center">Registro de Proyectos</h3>
                </div>
                <!-- Rutina de despliegue de errores --> 
                <?php if(isset($mensajeError)){ ?>
                        <div class="alert alert-danger">
                            <?php echo $mensajeError; ?>
                        </div>
                <?php } ?>
                <div class="card-body bg-primary text-white mb-2 border">
                    <form action="crearProyecto.php" method="post">

                        <div class="form-group">
                            <label for="nombre_Proyecto">Nombre del Proyecto</label>
                            <input type="text" class="form-control"
                            id="nombre_Proyecto" name="nombre_Proyecto" required 
                            placeholder="Escriba el nombre del proyecto"
                            title="Nombre del proyecto"
                            value="<?php echo $nombre_Proyecto; ?>"
                            pattern = "^[A-Za-z0-9.,*-_#@ÑñÁáÉéÍíÓóÚú ]{1,512}$"
                            rows="2">
                        </div>
                    
                        <div class="form-group">
                            <label for="tipo_Proyecto">Tipo de Proyecto</label>
                            <input type="text" class="form-control"
                            id="tipo_Proyecto" name="tipo_Proyecto" required 
                            placeholder="Escriba el tipo de proyecto"
                            title="Tipo de proyecto"
                            value="<?php echo $tipo_Proyecto; ?>"
                            pattern = "^[A-Za-z0-9.,*-_#@ÑñÁáÉéÍíÓóÚú ]{1,512}$">
                        </div>

                        <div class="form-group">
                            <label for="vacantes_Proyecto">Número de vacantes para alumnos</label>
                            <input type="number" class="form-control"
                            id="vacantes_Proyecto" name="vacantes_Proyecto" required 
                            placeholder="Escriba el número de vacantes para su proyecto"
                            title="Número de vacantes"
                            value="<?php echo $vacantes_Proyecto; ?>"
                            min="1" max="99">
                        </div>

                        <div class="form-group">
                            <label for="duracion_Proyecto">Duración del proyecto (semanas)</label>
                            <input type="number" class="form-control"
                            id="duracion_Proyecto" name="duracion_Proyecto" required 
                            placeholder="Escriba el número de semanas que durará el proyecto"
                            title="Duración del proyecto"
                            value="<?php echo $duracion_Proyecto; ?>"
                            min="1" max="99">
                        </div>

                        <div class="form-group">
                            <label for="requisitos_Proyecto">Requisitos del Proyecto</label>
                            <input type="text" class="form-control"
                            id="requisitos_Proyecto" name="requisitos_Proyecto" required 
                            placeholder="Escriba los requisitos del proyecto"
                            title="Requisitos del proyecto"
                            value="<?php echo $requisitos_Proyecto; ?>"
                            pattern = "^[A-Za-z0-9.,*-_#@ÑñÁáÉéÍíÓóÚú ]{1,512}$">
                        </div>

                        <div class="form-group">
                            <label for="descripcion_Proyecto">Descripción del Proyecto</label>
                            <input type="text" class="form-control"
                            id="descripcion_Proyecto" name="descripcion_Proyecto" required 
                            placeholder="Escriba la descripción del proyecto"
                            title="Descripción del proyecto"
                            value="<?php echo $descripcion_Proyecto; ?>"
                            pattern = "^[A-Za-z0-9.,*-_#@ÑñÁáÉéÍíÓóÚú ]{1,512}$">
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