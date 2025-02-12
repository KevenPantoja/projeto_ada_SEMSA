<!DOCTYPE html>
<html>
<head>
    <title>RELAÇÃO DE EQUIPES</title>
</head>
<body>
    <h1>RELAÇÃO DE EQUIPES</h1>
    <table border="1">
        <tr>
            <th>NU CNES</th>
            <th>Nome da Unidade</th>
            <th>Bairro</th>
        </tr>
        @foreach($dadosequipes as $listaREquipes)
            <tr>
                <td>{{ $listaREquipes->no_equipe }}</td>
                <td>{{ $listaREquipes->nu_ine }}</td>
                <td>{{ $listaREquipes->nu_cnes }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>