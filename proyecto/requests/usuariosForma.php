<?php
if(!$_SESSION['login']==1){
    header('Location: ../login/');
} else if(!$_SESSION['usuario_tipo']=='administrador'){
    header('Location: ../home/');
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
    <div class="row border">
        <div class="col card bg-success">
            <div class="card-header card-footer text-center bg-dark text-white">
                <h5>Usuarios Registrados</h5>
            </div>
            <div class="card-body">
                <?php echo $tabla; ?>
            </div>
        </div>
    </div>
</div>