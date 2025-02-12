<style>
    .caixa {
        border-radius: 10px;
        /* Define o raio das bordas */
        height: 60px;
        /* Define a altura */
        background-color: #f0f0f0;
        /* Cor de fundo da caixa */
        padding: 20px;
        /* Espaçamento interno */
        margin-bottom: 20px;
        /* Espaçamento inferior */
        /* Adicione outros estilos conforme necessário */
        margin: 20px auto;
        /* Espaçamento inferior e centralização horizontal */
        width: 65%;
        
        /* Define a largura da caixa */
        font-style: normal;
        font-family: Arial;
    }

    .caixa-corpo {
        border-radius: 10px;
        /* Define o raio das bordas */
        height: 1300px;
        /* Define a altura */
        background-color: darkgray;
        /* Cor de fundo da caixa */
        padding: 20px;
        /* Espaçamento interno */
        margin-bottom: 20px;
        /* Espaçamento inferior */
        /* Adicione outros estilos conforme necessário */
        margin: 20px auto;
        /* Espaçamento inferior e centralização horizontal */
        width: 65%;
        /* Define a largura da caixa */
        font-style: normal;
        font-family: Arial;
    }

    .caixa-corpo table {
        border-collapse: collapse;
        width: 100%;
        border: 3px solid black;
        /* Bordas mais grossas */
        border-radius: 10px;
        /* Borda em alto relevo */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        /* Sombra em alto relevo */
    }

    .caixa-corpo th,
    .caixa-corpo td {
        border: 3px solid black;
        padding: 8px;
        text-align: center;
        height: 50px;
        /* Defina a altura desejada aqui */
    }

    .ocultar-coluna {
        display: none;
    }

    .select-wrapper {
        display: inline-block;
        margin-right: 80px;
        /* Ajuste conforme necessário */
    }
</style>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISTEMA ADA</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
</head>

<body>
    <div class="caixa">
        <!-- Conteúdo da sua caixa aqui -->
        <h2>ADA - ANÁLISE DINÂMICA DAS EQUIPES DA ATENÇÃO PRIMÁRIA</h2>
    </div>

    <div class="caixa-corpo">
        <!-- Conteúdo da sua caixa aqui -->
        <div class="col">
            <div class="select-wrapper">
                <label for="selectCompetencia">COMPETÊNCIA:</label>
                <select id="selectCompetencia" onchange="filtrarDados()"
                    style="height: 30px; width: 200px; border-radius: 5px;">
                    <option value="-1">SELECIONE A COMPETÊNCIA</option>
                </select>
            </div>
            <div class="select-wrapper">
                <label for="selectUnidade">UNIDADE:</label>
                <select id="selectUnidade" onchange="filtrarDados()"
                    style="height: 30px; width: 400px; border-radius: 5px;">
                    <option value="-1">SELECIONE A UNIDADE</option>
                    @foreach ($unidades as $rel_unidades)
                        <option value="{{$rel_unidades}}">{{$rel_unidades}}</option>
                    @endforeach
                </select>
            </div>
            <div class="select-wrapper">
                <label for="selectDistrito">DISTRITO:</label>
                <select id="selectDistrito" onchange="filtrarDados()"
                    style="height: 30px; width: 300px; border-radius: 5px;">
                    <option value="-1">SELECIONE O DISTRITO</option>
                    <option value="-1">DISTRITO DE SAÚDE NORTE</option>
                    <option value="-1">DISTRITO DE SAÚDE SUL</option>
                    <option value="-1">DISTRITO DE SAÚDE LESTE</option>
                    <option value="-1">DISTRITO DE SAÚDE OESTE</option>
                    <option value="-1">DISTRITO DE SAÚDE RURAL</option>
                </select>
            </div>
        </div>

        <!-- <div>
            <button onclick="exportToExcel('tabelaDados')" style="border-radius: 10px; padding: 10px 20px; font-size: 16px; margin-top: 10px;">Exportar para Excel</button>
        </div> -->

        <div style="margin-top: 20px">
            <div style="text-align: center; font-weight: bold; font-size: 19px; border: 2px solid black; padding: 10px; border-radius: 10px;">
                CENÁRIO DE EQUIPES
            </div>
            <div class="table-responsive text-center">
                <table class="table table-striped table-hover" id="myTable" border="1"
                    style="border-collapse: collapse; border-radius: 10px; overflow: hidden">
                    <thead>
                        <tr>
                            <td style="padding: 10px;"><b>Unidade de Saúde</b></td>
                            <td style="padding: 10px;"><b>INE</b></td>
                            <td style="padding: 10px;"><b>Equipe</b></td>
                            <td style="padding: 10px;"><b>Nº PRT MS Homol</b></td>
                            <td style="padding: 10px;"><b>Tipo Homol</b></td>
                            <td style="padding: 10px;"><b>Nº PRT Informatiza</b></td>
                            <td style="padding: 10px;"><b>SNH Eqp Monit.</b></td>
                            <td style="padding: 10px;"><b>Dt. Ativação</b></td>
                            <td style="padding: 10px;"><b>Dt. Desativação</b></td>
                            <td style="padding: 10px;"><b>Vínculo</b></td>
                            <td style="padding: 10px;"><b>Alerta</b></td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($busca_cenario as $query)
                        <tr>
                            <td style="padding: 10px;">{{$query -> und_nome}}</td>
                            <td style="padding: 10px;">{{$query -> equi_ine}}</td>
                            <td style="padding: 10px;">{{$query -> equi_nome}}</td>
                            <td style="padding: 10px;">{{$query -> prt_homol}}</td>
                            <td style="padding: 10px;">{{$query -> tp_homol}}</td>
                            <td style="padding: 10px;">{{$query -> prt_informatiza}}</td>
                            <td style="padding: 10px;">{{$query -> prt_snh}}</td>
                            <td style="padding: 10px;">{{$query -> unid_equi_data_ativ}}</td>
                            <td style="padding: 10px;">{{$query -> unid_equi_data_desat}}</td>
                            <td style="padding: 10px;">{{$query -> eq_vinc}}</td>
                            <td style="padding: 10px;">{{$query -> desc_alerta}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-top: 40px">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-8">
                    <div
                        style="text-align: center; font-weight: bold; font-size: 19px; border: 2px solid black; padding: 10px; border-radius: 10px;">
                        RELAÇÃO DE PROFISSIONAIS EM EQUIPES NO CNES
                    </div>
                    <div class="table-responsive text-center">
                        <table class="table table-striped table-hover" id="myTable2" border="1"
                            style="border-collapse: collapse; border-radius: 10px; overflow: hidden">
                            <thead>
                                <tr>
                                    <td style="padding: 5px;"><b>Unidade de Saúde</b></td>
                                    <td style="padding: 5px;"><b>Equipe</b></td>
                                    <td style="padding: 5px;"><b>Nome do Profissional</b></td>
                                    <td style="padding: 5px;"><b>Descrição CBO</b></td>
                                    <td style="padding: 5px;"><b>CH Amb</b></td>
                                    <td style="padding: 5px;"><b>Vínculo</b></td>
                                    <td style="padding: 5px;"><b>Dt. Desligamento</b></td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($busca_profeq as $prof)
                                <tr>
                                    <td style="padding: 5px;">{{$prof -> und_nome}}</td>
                                    <td style="padding: 5px;">{{$prof -> equi_nome}}</td>
                                    <td style="padding: 5px;">{{$prof -> prof_nome}}</td>
                                    <td style="padding: 5px;">{{$prof -> cbo_descricao}}</td>
                                    <td style="padding: 5px;">{{$prof -> carg_quantidadehoras}}</td>
                                    <td style="padding: 5px;">{{$prof -> vinc_descricao}}</td>
                                    <td style="padding: 5px;">{{$prof -> und_eqp_prf_saida}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-8 col-md-4 col-3">
                    <div style="margin-left: 20px">
                        <div
                            style="text-align: center; font-weight: bold; font-size: 19px; border: 2px solid black; padding: 10px; border-radius: 10px;">
                            TOTAL DE PROFISSIONAIS POR CBO
                        </div>
                        <div class="table-responsive text-center">
                            <table class="mt-2 table table-striped table-hover" id="myTable3" style="border-collapse: collapse; border-radius: 10px; overflow: hidden">
                                <thead>
                                    <tr>
                                        <td style="padding: 1px; width: 45px"><b>Descrição do CBO</b></td>
                                        <td style="padding: 5px; width: 30px"><b>Total</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($total_prof as $tprof)
                                    <tr>
                                        <td style="padding: 1px;">{{$tprof -> cbo_descricao}}</td>
                                        <td style="padding: 5px;">{{$tprof -> total_prof}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px">
                <div style="text-align: center; font-weight: bold; font-size: 19px; border: 2px solid black; padding: 10px; border-radius: 10px;">
                    INFORMAÇÕES GERAIS
                </div>
                <div class="table-responsive text-center">
                    <table class="table table-striped table-hover" id="myTableInfoGerais" border="1" style="margin-top: 20px; border-collapse: collapse; border-radius: 10px; overflow: hidden;">
                        <thead>
                            <tr>
                                <td style="padding: 10px;"><b>Equipes Cadastradas</b></td>
                                <td style="padding: 10px;"><b>Equipes Homologadas MS</b></td>
                                <td style="padding: 10px;"><b>Saúde na Hora (SNH)</b></td>
                                <td style="padding: 10px;"><b>SNH Eqp Monitorada</b></td>
                                <td style="padding: 10px;"><b>Equipes do Informatiza APS</b></td>
                                <td style="padding: 10px;"><b>Equipes Incompletas</b></td>
                                <td style="padding: 10px;"><b>Equipes Desativadas Nesta Competência</b></td>
                                <td style="padding: 10px;"><b>Equipes a Desativar na Próx. Competência</b></td>
                                <td style="padding: 10px;"><b>Equipes a Desativar Daqui a duas Competências</b>
                                </td>
                                <td style="padding: 10px;"><b>Total de Alertas</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 10px;">Célula 7</td>
                                <td style="padding: 10px;">Célula 8</td>
                                <td style="padding: 10px;">Célula 9</td>
                                <td style="padding: 10px;">Célula 10</td>
                                <td style="padding: 10px;">Célula 11</td>
                                <td style="padding: 10px;">Célula 12</td>
                                <td style="padding: 10px;">Célula 8</td>
                                <td style="padding: 10px;">Célula 9</td>
                                <td style="padding: 10px;">Célula 10</td>
                                <td style="padding: 10px;">Célula 11</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "language": {
                        url: 'assets/js/pt_br.json'
                    },
                    "buttons": [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    "paging": true, // Habilita a paginação
                    "pageLength": 4, // Define o número de linhas por página
                    "pagingType": "simple_numbers" // Define o tipo de paginação
                });
                
                $('#myTable2').DataTable({
                    "language": {
                        url: 'assets/js/pt_br.json'
                    },
                    "buttons": [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    "paging": true, // Habilita a paginação
                    "pageLength": 4, // Define o número de linhas por página
                    "pagingType": "simple_numbers" // Define o tipo de paginação
                });
                
                $('#myTable3').DataTable({
                    "language": {
                        url: 'assets/js/pt_br.json'
                    },
                    "buttons": [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    "paging": true, // Habilita a paginação
                    "pageLength": 4, // Define o número de linhas por página
                    "pagingType": "simple_numbers" // Define o tipo de paginação
                }); 
                
                // Preencher o combobox de unidades com a lista de unidades distintas
                var unidades = @json($unidades); // Variável do backend com a lista de unidades

                unidades.forEach(function(unidade) {
                    $('#selectUnidade').append(`<option value="${unidade}">${unidade}</option>`);
                });

                $('#selectUnidade').on('change', function() {
                    var selectedUnit = $(this).val();
                    table.columns(0).search(selectedUnit).draw();
                });
                    });
        </script>

</body>

</html>
