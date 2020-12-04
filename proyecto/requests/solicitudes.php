<?php
    session_start();
    require_once '../includes/header.php';
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if(!$_SESSION['usuario_tipo']=='administrador'){
        header('Location: ../home/');
    }
    
    $sqlSelect = 'SELECT a.id, a.tipo, a.estado, b.username, c.nombre, c.id as id_proyecto 
                    FROM solicitud a, usuario b, proyecto c 
                    WHERE a.fk_usuario = b.id AND a.fk_proyecto=c.id';
    
    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $recordSet = $stmt->get_result();
    # Creamos la tabla
    $tabla = '<table id="miTabla" class="table table-bordered table-striped table-hover">';
    $tabla.= '<thead class="thead-dark">';
    $tabla.= '<tr>';
    $tabla.= '<th>ID</th>';
    $tabla.= '<th>Usuario</th>';
    $tabla.= '<th>Tipo</th>';
    $tabla.= '<th>Estado</th>';
    $tabla.= '<th>Proyecto</th>';
    $tabla.= '<th colspan="3" class="text-center"></th>';
    $tabla.= '</tr>';
    $tabla.= '</thead>';
    $tabla.= '<tbody>';
    if($recordSet->num_rows>0){
        $numSolicitud = 1;
        while($row = $recordSet->fetch_assoc()){
            $id_solicitud = $row['id'];
            $id_proyecto = $row['id_proyecto'];
            if($row['tipo'] == '0'){
                $tipo_solicitud = 'Unirse al proyecto';
            } else {
                $tipo_solicitud = 'Creación de proyecto';
            }
            if($row['estado'] == '0'){
                $estado_solicitud = 'En revisión';
            } else if($row['estado'] == '1'){
                $estado_solicitud = 'Aceptado';
            } else {
                $estado_solicitud = 'Rechazado';
            }

            $tabla.= '<tr class="bg-info">';
            $tabla.= '<td>'.$numSolicitud.'</td>';
            $tabla.= '<td>'.$row['username'].'</td>';
            $tabla.= '<td>'.$tipo_solicitud.'</td>';
            $tabla.= '<td>'.$estado_solicitud.'</td>';
            $tabla.= '<td>'.$row['nombre'].'</td>';
            
            $tabla.=    '<td>
                            <a href="solicitud.php?id='.$id_solicitud.'" class="btn btn-primary btn-sm text-white">
                                MÁS
                            </a>
                        </td>';
            $tabla.=    '<td>
                            <a href="aceptar.php?id='.$id_solicitud.'" class="btn btn-success btn-sm text-white">
                                ACEPTAR
                            </a>
                        </td>';
            $tabla.=    '<td>
                            <a href="rechazar.php?id='.$id_solicitud.'" class="btn btn-danger btn-sm text-white">
                                RECHAZAR
                            </a>
                        </td>';
            $tabla.= '</tr>';
            $numSolicitud += 1;
        }
    } else {
        #No hay Registros
        $tabla.= '<tr>';
        $tabla.= '<td colspan="5" class="text-center">NO HAY SOLICITUDES...</td>';
        $tabla.= '</tr>';
    }
    $tabla.= '</tbody>';
    $tabla.= '</table>';
    require_once 'solicitudesForma.php';
    require_once '../includes/piepagina.php';
    require_once '../includes/footer.php';
?>