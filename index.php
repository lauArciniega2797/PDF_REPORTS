<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
    <link rel="stylesheet" href="assets/css/styles.css"><link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap' rel='stylesheet'>
    <style>
        * { padding:0;margin:0;box-sizing:border-box; }
        body {
            font-family:'Roboto', sans-serif;
            font-size:16px;
            margin: 30px 20px;
        }
        #app_report #header table {
            width:100%;
        }
        #app_report #header table tr td:last-of-type {
            text-align:right;
            font-family:'Roboto', sans-serif!important;
        }
        #app_report #header table tr td h3 {
            letter-spacing:5px;
            text-transform: uppercase;
            font-size: 1.1em;
        }
        #app_report #header table tr td #tipoDoc, #app_report #header table tr td #vendedor, #app_report #header table tr td #fechaHra {
            font-size: .85em;
        }
        #app_report #header table tr td #tipoDoc, #app_report #header table tr td #vendedor {
            text-transform: uppercase;
            font-weight:bold;
        }
        #table_principal > table { 
            font-size:.7em;
            margin-top:1.2em;
            width: 100%;
        }
        #table_principal table:not(.table_cliente) thead {
            background-color: #ff9966;
        }
        #table_principal table:not(.table_cliente) tbody tr:nth-child(even){
            background-color: #ebf0f5;
        }
        #table_principal table.table_cliente tbody tr:nth-child(even){ background-color: transparent!important; }
        #table_principal table:not(.table_cliente) thead tr th:nth-child(1),  #table_principal table:not(.table_cliente) thead tr th:nth-child(3),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(1),  #table_principal table:not(.table_cliente) tbody tr td:nth-child(3) {
            text-align:left;
        }

        #table_principal table:not(.table_cliente) tbody tr td:nth-child(1),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(8),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(9) { width: 2%; }
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(2),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(7) { width: 5%; }
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(4),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(5),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(10),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(11) { width: 6%; }
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(6) { width: 7%; }

        #table_principal table:not(.table_cliente) tbody tr td:nth-child(2), #table_principal table:not(.table_cliente) tbody tr td:nth-child(4), #table_principal tbody tr td:nth-child(5),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(6), #table_principal table:not(.table_cliente) tbody tr td:nth-child(7), #table_principal tbody tr td:nth-child(8),
        #table_principal table:not(.table_cliente) tbody tr td:nth-child(9), #table_principal table:not(.table_cliente) tbody tr td:nth-child(10), #table_principal tbody tr td:nth-child(11) {
            text-align: center;
        }
        #table_principal table:not(.table_cliente) thead tr th:nth-child(12), #table_principal table:not(.table_cliente) tbody tr td:nth-child(12),
        #table_principal table:not(.table_cliente) thead tr th:nth-child(7), #table_principal table:not(.table_cliente) tbody tr td:nth-child(7) { text-align: right; }

        #table_principal table:not(.table_cliente) tbody tr td#numer_cell { font-size:.8em; }
        #table_principal table:not(.table_cliente) tbody tr td,
        #table_principal table:not(.table_cliente) thead th { padding: 6px }
        #table_principal table.table_cliente tbody tr td { padding: 0!important; width: unset; }

        #table_principal table.table_cliente { width:100%; }
        #table_principal table.table_cliente tbody tr:first-of-type td { margin-bottom: .3em }
        #table_principal table.table_cliente tbody tr:nth-child(2) { display:block; width: 95%; margin: 0 auto;}
        #table_principal table.table_cliente tbody tr:nth-child(2) td { width: 45%; display: inline-block; }
        #table_principal table.table_cliente tbody tr:nth-child(2) td:nth-child(2) { font-size: .8em; text-align: left; }
    </style>
</head>
<body>
    <section id='app_report'>
        <article id='header'>
            <table>
                <tr>
                    <td><h3>MAFENSA</h3></td>
                    <td><p id='tipoDoc'>{{ tipoDoc }}</p></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p id='vendedor'>{{ vendedor }}</p></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p id='fechaHra'>{{ fechaHra }}</p></td>
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
                <tbody>
                    <tr v-for="cliente in clientes">
                        <td id='numer_cell'>{{ cliente.no }}</td>
                        <td>{{ cliente.ref }}</td>
                        <td>
                            <table class='table_cliente'>
                                <tbody>
                                    <tr>
                                        <td colspan='2'>
                                            <p>{{ cliente.cliente }}</p>
                                        </td>
                                    </tr>
                                    <tr v-if="cliente.email || cliente.email2">
                                        <td v-if="cliente.email != '' && cliente.email2 == ''"><small>{{ cliente.email }}</small></td>
                                        <td v-if="cliente.email2 != '' && cliente.email == ''"><small>{{ cliente.email2 }}</small></td>
                                        <td v-if="cliente.email2 && cliente.email"><small>{{ cliente.email + '; ' + cliente.email2}}</small></td>
                                        <td v-if="cliente.obs">{{ cliente.obs }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>{{ cliente.contacto }}</td>
                        <td>{{ cliente.telefonos }}</td>
                        <td>{{ cliente.ultCompra }}</td>
                        <td>{{ cliente.limite }}</td>
                        <td>{{ cliente.pp }}</td>
                        <td>{{ cliente.venc }}</td>
                        <td>{{ cliente.revision }}</td>
                        <td>{{ cliente.pago }}</td>
                        <td>{{ cliente.montoFactura }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total de clientes: {{ counter }}</td>
                    </tr>
                </tbody>
            </table>
        </article>
    </section>

    <h4>Hacemos el PDF?</h4>
    <button @click="createPFD()">Si, hagamoslo!</button>

    <script src="assets/js/vue.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>