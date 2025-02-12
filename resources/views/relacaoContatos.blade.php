<!DOCTYPE html>
<html>
<head>
    <title>RELAÇÃO DE CONTATOS</title>
</head>
<body>
    <h1>RELAÇÃO DE CONTATOS</h1>
    <table border="1">
        <tr>
            <th>CPF</th>
            <th>Data de Nascimento</th>
            <th>Idade</th>
            <th>Sexo</th>
            <th>Nome do Contato</th>
            <th>Nome da Mãe</th>
            <th>Classificação</th>
        </tr>
        @foreach($dadosContatos as $RelacaoContatos)
            <tr>
                <td>{{ $RelacaoContatos-> nu_cpf}}</td>
                <td>{{ $RelacaoContatos-> dt_nascimento}}</td>
                <td>{{ $RelacaoContatos-> idade}}</td>
                <td>{{ $RelacaoContatos-> sexo}}</td>
                <td>{{ $RelacaoContatos-> no_contato}}</td>
                <td>{{ $RelacaoContatos-> no_mae}}</td>
                <td>
                    @if ($RelacaoContatos-> idade < 18)
                        Adolescente
                    @else
                        Adulto
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>