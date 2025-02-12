<!DOCTYPE html>
<html>
<head>
    <title>Lista de Unidades de Saúde</title>
</head>
<body>
    <h1>Lista de Unidades de Saúde</h1>
    <table border="1">
        <tr>
            <th>NU CNES</th>
            <th>Nome da Unidade</th>
            <th>Bairro</th>
        </tr>
        @foreach($unidadesSaude as $listaunidadeSaude)
            <tr>
                <td>{{ $listaunidadeSaude->nu_cnes }}</td>
                <td>{{ $listaunidadeSaude->no_unidade_saude }}</td>
                <td>{{ $listaunidadeSaude->no_bairro }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>