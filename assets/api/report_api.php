<?php
use Dompdf\Dompdf;

error_reporting(E_ALL);
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=reporte_clientes.pdf");

include('../config/db.php');
require_once '../dompdf/autoload.inc.php';

$vendedor = "01 MONSERRAT";
$tipoDoc = "General de clientes";

$flag = true;
$objetoHTML = "
    <html>
        <head>
            <title>Reporte de clientes</title>
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap' rel='stylesheet'>
            <style>
                * { padding:0;margin:0;box-sizing:border-box; }
                body {
                    font-family:'Roboto', sans-serif;
                    font-size:16px;
                    margin: 30px 20px;
                }
                #principal #header table {
                    width:100%;
                }
                #principal #header table tr td:last-of-type {
                    text-align:right;
                    font-family:'Roboto', sans-serif!important;
                }
                #principal #header table tr td h3 {
                    letter-spacing:5px;
                    text-transform: uppercase;
                    font-size: 1.1em;
                }
                #principal #header table tr td #tipoDoc, #principal #header table tr td #vendedor, #principal #header table tr td #fechaHra {
                    font-size: .85em;
                }
                #principal #header table tr td #tipoDoc, #principal #header table tr td #vendedor {
                    text-transform: uppercase;
                    font-weight:bold;
                }

                #table_principal > table { 
                    font-size:.7em;
                    margin-top:1.2em;
                }
                #table_principal thead tr th:nth-child(1),  #table_principal thead tr th:nth-child(3),
                #table_principal thead tr th:nth-child(4),  #table_principal thead tr th:nth-child(5),
                #table_principal thead tr th:nth-child(6),  #table_principal thead tr th:nth-child(7),
                #table_principal thead tr th:nth-child(8),  #table_principal thead tr th:nth-child(9),
                #table_principal thead tr th:nth-child(10), #table_principal thead tr th:nth-child(11) {
                    text-align:left;
                }

                #table_principal table tbody tr td#numer_cell { font-size:.8em; }
                #table_principal table tbody tr td,
                #table_principal table thead th { padding: 0 5px }
                #table_principal table.table_cliente tbody tr td { padding: 0!important; }

                #table_principal table.table_cliente { width:100%; }
                #table_principal table.table_cliente tbody tr:first-of-type td { margin-bottom: .3em }
                #table_principal table.table_cliente tbody tr:last-of-type td:last-of-type { font-size: .7em; }
            </style>
        </head>
        <body>
            <section id='principal'>
                <article id='header'>
                    <table>
                        <tr>
                            <td><h3>MAFENSA</h3></td>
                            <td><p id='tipoDoc'>$tipoDoc</p></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><p id='vendedor'>$vendedor</p></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><p id='fechaHra'>". date('d/m/Y H:i:sa') ."</p></td>
                        </tr>
                    </table>
                </article>
                <article id='table_principal'>
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ref.</th>
                                <th>Cliente</th>
                                <th>Contacto</th>
                                <th>Telefonos</th>
                                <th>Ult. Compra</th>
                                <th>Limite Cred.</th>
                                <th>P.P</th>
                                <th>Venc.</th>
                                <th>Revisión</th>
                                <th>Pago</th>
                                <th>Monto Fact.</th>
                            </tr>
                        </thead>
                        <tbody>";

                        #Aquí se realizará la llamada de los datos y la creación de las filas de las tablas
                        $consulta = $conn->query("SELECT c.cliente AS 'no', r.referencia AS 'ref', c.nombre AS 'cliente', c.email, c.email2, c.obs_cli AS 'obs',  
                            c.telefono as 'telefonos', c.fecha_ucompra AS 'ultCompra', c.limite, c.dias_factura AS 'venc', c.monto_factura AS 'montoFactura'
                            FROM mln_clientes c
                            LEFT JOIN referencias_cte r ON r.cliente = c.cliente 
                            WHERE c.vendedor = 02
                            AND c.activo = 1
                            ORDER BY cliente ASC");

                        if($consulta){
                            $counter = 0;

                            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                $counter++;
                                $fila['pp'] = 0;
                                $fila['pago'] = 'TRANSFERENCIA';
                                $fila['venc'] = 100;
                                $fila['contacto'] = 'Laurencia';
                                $fila['revision'] = 'TRANSFERENCIA';

                                $objetoHTML .= "<tr>
                                                    <td id='numer_cell'>" . $fila['no'] . "</td>
                                                    <td>" . $fila['ref'] . "</td>
                                                    <td>
                                                        <table class='table_cliente'>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan='2'><p>" .$fila['cliente']. "</p></td>
                                                                </tr>";
                                                                
                                                                if($fila['email'] or $fila['email2']) {
                                                                    $objetoHTML .= "<tr>";
                                                                }

                                                                if($fila['email'] <> '' and $fila['email2'] == '') {
                                                                    $objetoHTML .= "<td><small>" . $fila['email'] . "</small></td>";
                                                                } else if($fila['email2'] <> '' and $fila['email'] <> ''){
                                                                    $objetoHTML .= "<td><small>" . $fila['email2'] . "</small></td>";
                                                                } else if($fila['email'] and $fila['email2']){
                                                                    $objetoHTML .= "<td><small>" . $fila['email2'] . "; " . $fila['email2'] . "</small></td>";
                                                                }

                                                                if($fila['obs']){
                                                                    $objetoHTML .= "<td>" . $fila['obs'] . "</td>";
                                                                }

                                                                if($fila['email'] or $fila['email2']) {
                                                                    $objetoHTML .= "</tr>";
                                                                }

                                $objetoHTML .=              "</tbody>
                                                        </table>
                                                    </td>
                                                    <td>" . $fila['contacto'] . "</td>
                                                    <td>" . $fila['telefonos'] . "</td>
                                                    <td>" . $fila['ultCompra'] . "</td>
                                                    <td>" . $fila['limite'] . "</td>
                                                    <td>" . $fila['pp'] . "</td>
                                                    <td>" . $fila['venc'] . "</td>
                                                    <td>" . $fila['revision'] . "</td>
                                                    <td>" . $fila['pago'] . "</td>
                                                    <td>" . $fila['montoFactura'] . "</td>
                                                </tr>";
                            }

                            $objetoHTML .= "<tr><td></td><td></td><td>Total de clientes: $counter</td></tr>";
                        }

$objetoHTML .=          "</tbody>
                    </table>
                </article>
            </section>
        </body>
    </html>
";

if(!$flag) $objetoHTML = '';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($objetoHTML);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("reporte_clientes.pdf");