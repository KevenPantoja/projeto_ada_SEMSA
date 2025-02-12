@extends('layouts.sidebar_info')

@section('title', 'Informações Gerais')

@section('content')
<div class="container mt-4">
    <form id="filtroForm" method="GET" action="dadosEquipes">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-6 col-sm-4">
                <div class="mb-3">
                    <label for="selectCompetencia" class="form-label">COMPETÊNCIA:</label>
                    <select id="selectCompetencia" name="competencia" class="form-select" onchange="fetchData()">
                        <option value="-1">TODAS</option>
                        @foreach ($competencias as $listacompetencias)
                        <option value="{{$listacompetencias}}">{{$listacompetencias}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6 col-sm-4">
                <div class="mb-3">
                    <label for="selectDistrito" class="form-label">DISTRITO:</label>
                    <select id="selectDistrito" name="distrito" class="form-select" onchange="handleDistritoChange()">
                        <option value="-1">TODOS</option>
                        @foreach ($distritos as $listadistritos)
                        <option value="{{$listadistritos}}">{{$listadistritos}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6 col-sm-4">
                <div class="mb-3">
                    <label for="selectUnidade" class="form-label">UNIDADE DE SAÚDE:</label>
                    <select id="selectUnidade" name="unidades" class="form-select" onchange="fetchData()">
                        <option value="-1">SELECIONE A UNIDADE</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div id="loading" class="loading">Carregando dados...</div>
    <div id="dataContainer" class="row g-4" style="display: none;">
        <div class="row justify-content-center align-items-center g-3">
            <!-- Card Total de Alertas -->
            <div class="col-12 col-sm-6 mb-3">
                <div class="card-alertas clickable-card h-100 show-spinner" id="totalAlertasCard"  data-bs-toggle="tooltip" title="Clicar para detalhes">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="card-icon d-flex align-items-center justify-content-center">
                            <i class="bi bi-exclamation-circle-fill" style="font-size: 2rem; color: #f58856;"></i>
                        </div>
                        <b class="card-title text-center mt-2 show-spinner" >Total de Alertas (Clique para visualizar)</b>
                        <div class="d-flex align-items-center card-text mt-2" id="alertas"></div>
                    </div>
                </div>
            </div>
            <!-- Card Total de Equipes -->
            <div class="col-12 col-sm-6 mb-3">
                <div class="card h-100 clickable-card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="card-icon d-flex align-items-center justify-content-center">
                            <i class="bi bi-people-fill" style="font-size: 2rem; color: #4B0082;"></i>
                        </div>
                        <b class="card-title text-center mt-2">Total de Equipes Cadastradas</b>
                        <div class="d-flex justify-content-center align-items-center card-text mt-2" id="totalequipes"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function fetchData() {
        $('#loading').show();
        $('#dataContainer').hide();

        $.ajax({
            url: "{{ route('dadosEquipes') }}",
            method: 'GET',
            data: $('#filtroForm').serialize(),
            success: function(response) {
                $('#dataContainer').html($(response).find('#dataContainer').html());
                $('#loading').hide();
                $('#dataContainer').show();
                $('#alertas').text(JSON.stringify(response.total_Registros_Alertas));
                $('#totalequipes').text(JSON.stringify(response.total_equipes));
            }
        });
    }

    $(document).ready(function() {
        fetchData();

        $('#selectDistrito').change(function() {
            var distrito = $(this).val();

            if (distrito) {
                $.ajax({
                    url: '/getUnidades/' + distrito,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('#selectUnidade').empty();
                        $('#selectUnidade').append('<option value="-1">TODAS</option>');
                        $.each(response, function(key, value) {
                            $('#selectUnidade').append('<option value="' + value + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#selectUnidade').empty();
                $('#selectUnidade').append('<option value="-1">SELECIONE O DISTRITO</option>');
            }
        });

        $('#totalAlertasCard').on('click', function() {
            var competencia = $('#selectCompetencia').val();
            var distrito = $('#selectDistrito').val();
            var unidade = $('#selectUnidade').val();

            $.ajax({
                url: "{{ route('listarAlertas') }}",
                method: 'POST',
                data: {
                    competencia: competencia,
                    distrito: distrito,
                    unidade: unidade,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = '/alertas?competencia=' + competencia + '&distrito=' + distrito;
                }
            });
        });
    });
</script>

@endsection
