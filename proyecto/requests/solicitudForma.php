<?php
if(!$_SESSION['login']==1){
    header('Location: ../login/');
} else if(!$_SESSION['usuario_tipo']=='administrador'){
    header('Location: ../home/');
}
?>
<style>
    body{
        background-image: url('../img/fondo2.png');
        background-size: cover;
    }
</style>
<div class="container-fluid border bg-dark text-center text-white">
    <div class="row">
        <div class="col">
            <a href="../home" class="btn btn-primary btn-sm float-left mt-2 ml-4 mb-2"><h2>HOME</h2></a>
            <a href="solicitudes.php" class="btn btn-warning btn-sm mt-2 mb-2"><h2>Regresar</h2></a>
            <a href="../home/logout.php" class="btn btn-danger btn-sm float-right mt-2 mr-4 mb-2"><h2>LOGOUT</h2></a>
        </div>
    </div>
</div>
<div class="container pt-3">
    <div class="row border">
        <div class="col bg-info">
            <h2 class="text-center bg-dark text-white mt-2"> Proyecto:  <?php echo $nombre_Proyecto;?> </h2>
            <a href="aceptar.php?id=<?php echo $_GET['id']?>" class="btn btn-success btn-sm float-left mt-2 mr-4 mb-2">
                <h2>ACEPTAR</h2>
            </a>
            <a href="rechazar.php?id=<?php echo $_GET['id']?>" class="btn btn-danger btn-sm float-right mt-2 mr-4 mb-2">
                <h2>RECHAZAR</h2>
            </a>
        </div>
    </div>
    <div class="row pt-5 pb-5">
        <div class="col bg-success border">
            <ul class="text-justify text-white mt-2">
                <li> <h5> Usuario:  <?php echo $nombre_Usuario;?> </h5> </li>
                <li> <h5> Tipo de solicitud:  <?php echo $tipo_Solicitud;?> </h5> </li>
                <li> <h5> Estado de solicitud:  <?php echo $estado_Solicitud;?> </h5> </li>
                <?php if(isset($nombre_Alumno)){?>
                    <li> <h5> Nombre del Alumno:  <?php echo $nombre_Alumno;?> </h5> </li>
                    <li> <h5> Carrera del Alumno:  <?php echo $carrera_Alumno;?> </h5> </li>
                    <li> <h5> Teléfono del Alumno:  <?php echo $telefono_Alumno;?> </h5> </li>
                    <li> <h5> Semestre del Alumno:  <?php echo $semestre_Alumno;?> </h5> </li>
                    <li> <h5> Número de Control del Alumno:  <?php echo $numControl_Alumno;?> </h5> </li>
                <?php } else if(isset($nombre_Profesor)){ ?>
                    <li> <h5> Nombre del Profesor:  <?php echo $nombre_Profesor;?> </h5> </li>
                    <li> <h5> Carrera del Profesor:  <?php echo $carrera_Profesor;?> </h5> </li>
                    <li> <h5> Teléfono del Profesor:  <?php echo $telefono_Profesor;?> </h5> </li>
                    <li> <h5> RFC del Profesor:  <?php echo $rfc_Profesor;?> </h5> </li>
                <?php } ?>
            </ul>
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