<?php
if(!$_SESSION['login']==1){
    header('Location: ../login/');
} else if(!isset($_GET['id'])){
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
    <div class="container pt-5">
        <!-- Rutina de despliegue de exito --> 
        <?php if(isset($mensajeExito)){ ?>
            <div class="alert alert-success pt-2 mb-2 text-center text-dark">
                <h4> <?php echo $mensajeExito; ?> </h4>
            </div>
        <?php } ?>
        <!-- Rutina de despliegue de informacion --> 
        <?php if(isset($mensajeInfo)){ ?>
            <div class="alert alert-primary pt-2 mb-2 text-center text-dark">
                <h4> <?php echo $mensajeInfo; ?> </h4>
            </div>
        <?php } ?>
        <div class="row border">
            <div class="col bg-success">
                <h2 class="text-center bg-dark text-white mt-2"> Proyecto:  <?php echo $nombre_Proyecto;?> </h2>
                <?php
                    if($_SESSION['usuario_tipo'] == 'alumno' || $_SESSION['usuario_tipo'] == 'profesor'){?>
                        <a href="../requests/solicitarUnion.php?id=<?php echo $_GET['id']?>" class="btn btn-info btn-sm float-right mt-2 mr-4 mb-2">
                            <h2>SOLICITAR UNIRSE AL PROYECTO</h2>
                        </a>
                <?php }?>
                
            </div>
        </div>
        <div class="row pt-5 pb-5">
            <div class="col-6 bg-success border">
                <ul class="text-justify text-white mt-2">
                    <li> <h5> Tipo:  <?php echo $tipo_Proyecto;?> </h5> </li>
                    <li> <h5> Vacantes:  <?php echo $vacantes_Proyecto;?> </h5> </li>
                    <li> <h5> Duración:  <?php echo $duracion_Proyecto;?> semanas </h5> </li>
                    <li> <h6> Requisitos:  <?php echo $requisitos_Proyecto;?> </h6> </li>
                    <li> <h6> Descripción:  <?php echo $descripcion_Proyecto;?> </h6> </li>
                </ul>
            </div>
            <div class="col"></div>
            <div class="col-5 bg-success border">
                <ul class="text-justify text-white mt-2">
                    <li> <h4> Empresa:  <?php echo $nombre_Empresa;?> </h4> </li>
                    <li> <h4> Ubicación:  <?php echo $ubicacion_Empresa;?> </h4> </li>
                    <li> <h4> Teléfono:  <?php echo $telefono_Empresa;?> </h4> </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container pt-3">
        <div class="row border">
            <div class="col bg-success">
                <h2 class="text-center bg-dark text-white mt-2"> COMENTARIOS:</h2>
            </div>
        </div>
        <?php 
            if(!isset($num_Comentario)){?>
                <div class="row border mt-2">
                    <div class="col bg-success">
                        <h2 class="text-center bg-dark text-white mt-2"> NO HAY COMENTARIOS</h2>
                    </div>
                </div>
        <?php } else { 
                    $cont=1;
                    while($cont<$num_Comentario){ ?>
                        <div class="row border mt-2">
                            <div class="col bg-success">
                                <h5 class="text-justify bg-dark text-white mt-2 pl-4"> <?php echo $comentarios[$cont] ?> </h5>
                            </div>
                        </div>
                    <?php $cont+=1;
                    }
            } ?>

            <div class="row mt-4">
                <div class="col">
                <div class="card-body bg-success text-white mb-2 border">
                    <form method="post" action='proyecto.php?id=<?php echo $_GET['id']?>'>
                        <div class="form-group">
                            <label for="agregar_Comentario">Agregar comentario</label>
                            <input type="text" class="form-control" 
                            id="agregar_Comentario" name="agregar_Comentario" required
                            placeholder="Escriba un comentario"
                            title="Escriba un comentario (512 Caracteres max.)"
                            value="<?php echo $agregar_Comentario; ?>"
                            pattern="^[A-Za-z0-9.,*-_#@ÑñÁáÉéÍíÓóÚú ]{1,512}$">
                        </div>
                        <div class="text-right">
                            <input type="submit" name="btnRegistrar" 
                            class="btn btn-info"
                            value="AGREGAR COMENTARIO">
                        </div>
                    </form>
                    <!-- Rutina de despliegue de errores --> 
                    <?php if(isset($mensajeError)){ ?>
                            <div class="alert alert-danger mt-2">
                                <?php echo $mensajeError; ?>
                            </div>
                    <?php } ?>
                </div>
            </div>
        
    </div>

</div>