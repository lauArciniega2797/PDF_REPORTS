<?php
error_reporting(E_ALL);
header("Content-type: application/json");

include('../config/db.php');

$result = array('error' => false);

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if($action == 'getData'){
    $datos = array();
    $consulta = $conn->query("SELECT c.cliente AS 'no', r.referencia AS 'ref', c.nombre AS 'cliente', c.email, c.email2, c.obs_cli AS 'obs',  
        c.telefono as 'telefonos', c.fecha_ucompra AS 'ultCompra', c.limite, c.dias_factura AS 'venc', c.monto_factura AS 'montoFactura'
        FROM mln_clientes c
        LEFT JOIN referencias_cte r ON r.cliente = c.cliente 
        WHERE c.vendedor = 02
        AND c.activo = 1
        ORDER BY cliente ASC");

    if($consulta) {
        $counter = 0;
        while($fila = $consulta->fetch(PDO::FETCH_ASSOC)){
            $counter++;
            $fila['pp'] = 100;
            $fila['pago'] = 'TRANSFERENCIA';
            $fila['contacto'] = 'Laurenciaa';
            $fila['revision'] = 'TRANSFERENCIA';
            $fila['venc'] = '190';

            array_push($datos, $fila);
        }
        $result['counter'] = $counter;
        $result['datos'] = $datos;
    } else {
        $result['error'] = true;
    }
}

$conn = null;
echo json_encode($result);
die();
?>