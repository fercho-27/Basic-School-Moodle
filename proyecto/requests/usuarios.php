<?php
    session_start();
    require_once '../includes/header.php';
    require_once '../bd/conexion.php';

    if(!$_SESSION['login']==1){
        header('Location: ../login/');
    } else if(!$_SESSION['usuario_tipo']=='administrador'){
        header('Location: ../home/');
    }
    
    $sqlSelect = 'SELECT id, username, correo, tipo, estado FROM usuario WHERE tipo!=0';
    
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
    $tabla.= '<th>Correo</th>';
    $tabla.= '<th colspan="3" class="text-center"></th>';
    $tabla.= '</tr>';
    $tabla.= '</thead>';
    $tabla.= '<tbody>';
    if($recordSet->num_rows>0){
        $numUsuario = 1;
        while($row = $recordSet->fetch_assoc()){
            $id_Usuario = $row['id'];
            $tipo = $row['tipo']==1?'Empresa':($row['tipo']==2?'Alumno':'Profesor');
            $estado = $row['estado']==0?'En revisión':($row['estado']==1?'Aceptado':'Rechazado');

            $tabla.= '<tr class="bg-info">';
            $tabla.= '<td>'.$numUsuario.'</td>';
            $tabla.= '<td>'.$row['username'].'</td>';
            $tabla.= '<td>'.$tipo.'</td>';
            $tabla.= '<td>'.$estado.'</td>';
            $tabla.= '<td>'.$row['correo'].'</td>';
            
            $tabla.=    '<td>
                            <a href="usuario.php?id='.$id_Usuario.'&tipo='.$row['tipo'].'" class="btn btn-primary btn-sm text-white">
                                MÁS
                            </a>
                        </td>';
            $tabla.=    '<td>
                            <a href="aceptarUsuario.php?id='.$id_Usuario.'" class="btn btn-success btn-sm text-white">
                                ACEPTAR
                            </a>
                        </td>';
            $tabla.=    '<td>
                            <a href="rechazarUsuario.php?id='.$id_Usuario.'" class="btn btn-danger btn-sm text-white">
                                RECHAZAR
                            </a>
                        </td>';
            $tabla.= '</tr>';
            $numUsuario += 1;
        }
    } else {
        #No hay Registros
        $tabla.= '<tr>';
        $tabla.= '<td colspan="5" class="text-center">NO HAY USUARIOS...</td>';
        $tabla.= '</tr>';
    }
    $tabla.= '</tbody>';
    $tabla.= '</table>';
    require_once 'usuariosForma.php';
    require_once '../includes/piepagina.php';
    require_once '../includes/footer.php';
?>