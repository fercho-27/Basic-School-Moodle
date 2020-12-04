<?php
    session_start();
    require_once '../includes/header.php';
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    }

    if(isset($_SESSION['mensaje_creacion']) && isset($_SESSION['mensaje_creacionF']) && $_SESSION['mensaje_creacionF']=='1'){
        $mensajeExito = $_SESSION['mensaje_creacion'];
        $_SESSION['mensaje_creacionF'] = '0';
    }

    //MOSTRAR ESTADO DE SOLICITUD PARA LAS EMPRESAS
    if($_SESSION['usuario_tipo'] == 'empresa'){
        $sqlSelect = 'SELECT a.id as id_proyecto, a.nombre, a.tipo, a.vacantes, a.duracion, a.fk_empresa, b.id, b.nombre as nombre_empresa, c.estado 
                        FROM proyecto a, empresa b, solicitud c WHERE c.fk_proyecto=a.id AND a.fk_empresa = b.id AND b.nombre = 
                        (SELECT c.nombre FROM empresa c, usuario d WHERE c.fk_usuario=d.id AND d.username=\''.$_SESSION['usuario'].'\')';
    } else {
        $sqlSelect = 'SELECT DISTINCT a.id as id_proyecto, a.nombre, a.tipo, a.vacantes, a.duracion, b.nombre as nombre_empresa 
                        FROM proyecto a, empresa b, solicitud c WHERE a.fk_empresa = b.id AND 
                            ((a.fk_empresa=0 AND b.id=0) OR (c.fk_proyecto=a.id AND c.estado=1))';
    }
    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    # Creamos la tabla
    $tabla = '<table id="miTabla" class="table table-bordered table-striped table-hover">';
    $tabla.= '<thead class="thead-dark">';
    $tabla.= '<tr>';
    $tabla.= '<th>ID</th>';
    $tabla.= '<th>Nombre</th>';
    $tabla.= '<th>Tipo</th>';
    $tabla.= '<th>Vacantes</th>';
    $tabla.= '<th>Duracion</th>';
    if($_SESSION['usuario_tipo']=='empresa'){
        $tabla.= '<th>Estado</th>';
    } else {
        $tabla.= '<th>Empresa</th>';
    }
    $tabla.= '<th colspan="3" class="text-center"></th>';
    $tabla.= '</tr>';
    $tabla.= '</thead>';
    $tabla.= '<tbody>';
    if($recordSet->num_rows>0){
        $numProyecto = 1;
        while($row = $recordSet->fetch_assoc()){
            $tabla.= '<tr class="bg-info">';
            $tabla.= '<td>'.$numProyecto.'</td>';
            $tabla.= '<td>'.$row['nombre'].'</td>';
            $tabla.= '<td>'.$row['tipo'].'</td>';
            $tabla.= '<td>'.$row['vacantes'].'</td>';
            $tabla.= '<td>'.$row['duracion'].'</td>';
            if($_SESSION['usuario_tipo']=='empresa'){
                $estado = $row['estado']==0?'En revisión':($row['estado']==1?'Aceptado':'Rechazado');
                $tabla.= '<td>'.$estado.'</td>';
            } else{
                $tabla.= '<td>'.$row['nombre_empresa'].'</td>';
            }
            $id = $row['id_proyecto'];
            $tabla.=    '<td>
                            <a href="proyecto.php?id='.$id.'" class="btn btn-success btn-sm text-white">
                                MÁS
                            </a>
                        </td>';
            $tabla.= '</tr>';
            $numProyecto += 1;
        }
    } else {
        #No hay Registros
        $tabla.= '<tr>';
        $tabla.= '<td colspan="7" class="text-center bg-info">NO HAY PROYECTOS DISPONIBLES...</td>';
        $tabla.= '</tr>';
    }
    $tabla.= '</tbody>';
    $tabla.= '</table>';
    require_once 'proyectosForma.php';
    require_once '../includes/piepagina.php';
    require_once '../includes/footer.php';
?>

