<!-- 
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>


<table id="myTable" class="display">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table>
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable</title>
    <!-- Inclua a biblioteca DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
</head>
<body>
    <div style="margin-top: 20px">
        <!-- Tabela HTML com o ID "myTable" -->
        <table id="myTable" border="1" style="border-collapse: collapse; border-radius: 10px; overflow: hidden;">
            <thead>
                <tr>
                    <th>Unidade de Saúde</th>
                    <th>INE</th>
                    <th>Equipe</th>
                    <th>Nº PRT MS Homol</th>
                    <th>Tipo Homol</th>
                    <th>Nº PRT Informatiza</th>
                    <th>SNH Eqp Monit.</th>
                    <th>Dt. Ativação</th>
                    <th>Dt. Desativação</th>
                    <th>Vínculo</th>
                    <th>Alerta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Célula 7</td>
                    <td>Célula 8</td>
                    <td>Célula 9</td>
                    <td>Célula 10</td>
                    <td>Célula 11</td>
                    <td>Célula 7</td>
                    <td>Célula 8</td>
                    <td>Célula 9</td>
                    <td>Célula 10</td>
                    <td>Célula 11</td>                    
                    <td>Célula 11</td>                    
                </tr>
                <!-- Adicione mais linhas aqui conforme necessário -->
            </tbody>
        </table>
    </div>

    <!-- Bloco de script para inicializar o DataTable -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>