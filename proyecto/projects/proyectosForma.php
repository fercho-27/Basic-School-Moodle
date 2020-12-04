<?php
if(!$_SESSION['login']==1){
    header('Location: ../login/');
}
?>
<div class="container-fluid border bg-dark text-center text-white">
    <div class="row">
        <div class="col">
            <a href="../home" class="btn btn-primary btn-sm float-left mt-2 ml-4 mb-2"><h2>HOME</h2></a>
            <a href="../home/logout.php" class="btn btn-danger btn-sm float-right mt-2 mr-4 mb-2"><h2>LOGOUT</h2></a>
        </div>
    </div>
</div>
<style>
    body{
        background-image: url('../img/fondo1.png');
        background-size: cover;
    }
</style>
<div class="container pt-3">
    <!-- Rutina de despliegue de exito --> 
    <?php if(isset($mensajeExito)){ ?>
                <div class="alert alert-success pt-2 mb-2 text-center text-dark">
                    <h4> <?php echo $mensajeExito; ?> </h4>
                </div>
        <?php } ?>
    <div class="row border">
        <div class="col card bg-success">
            <div class="card-header card-footer text-center bg-dark text-white">
                <h5>Proyectos Disponibles</h5>
            </div>
            <div class="card-body">
                <?php
                    if($_SESSION['usuario_tipo'] == 'empresa' || $_SESSION['usuario_tipo'] == 'administrador'){?>
                        <a href="crearProyecto.php" class="btn btn-primary mb-3">
                            CREAR PROYECTO
                        </a>
                <?php }?>
                <?php echo $tabla; ?>
            </div>
        </div>
    </div>
</div>