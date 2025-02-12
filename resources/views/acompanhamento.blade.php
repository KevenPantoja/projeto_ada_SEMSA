@extends('layouts.sidebar')

@section('title', 'Acompanhamento')

@section('content')


<div class="container mt-4">
    <div class="alert alert-warning position-relative text-center p-5" role="alert">
        <!-- Botão Close Reposicionado -->
        <button type="button" class="close position-absolute" style="top: 10px; right: 10px;" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <!-- Conteúdo Centralizado -->
        <h4 class="alert-heading">Aviso!</h4>
        <p>A área de acompanhamento trata-se de uma funcionalidade em desenvolvimento. Em breve traremos mais novidades!</p>
        <hr>
        <p>© Diretoria de Inteligência de Dados - DID/SEMSA</p>
    </div>

    <h3 class="text-center mt-4 mb-4">Acompanhamento de Alerta</h3>

    <form>
        <div class="form-group row mb-4">
            <label for="staticEmail" class="col-sm-2 col-form-label">Unidade: </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $dadosAlerta['unidade'] ?? '' }}">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="staticEmail" class="col-sm-2 col-form-label">Responsável da unidade: </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $dadosAlerta['unidade'] ?? '' }}">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="staticEmail" class="col-sm-2 col-form-label">Equipe: </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $dadosAlerta['equipe'] ?? '' }}">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="staticEmail" class="col-sm-2 col-form-label">Alerta: </label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $dadosAlerta['ocorrencia'] ?? '' }}">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="staticEmail" class="col-sm-2 col-form-label">Registro de acompanhamento: </label>
            <div class="col-sm-10">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
            </div>
        </div>

        <!-- Botão centralizado -->
        <div class="text-center">
            <button type="button" class="btn btn-secondary" disabled>Enviar Registro</button>
        </div>
    </form>

    <h5 class="mt-4 mb-4">Ações Tomadas:</h5>

    <div class="container-fluid mt-4 mb-4">
        <div class="table-container2">
            <div class="table-wrapper table-responsive">
                <table id="TabUnidadeAlertas" class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr style="background-color:#508C9B">
                            <th>Data</th>
                            <th>Profissional Responsável</th>
                            <th>Registro</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="uni-row ">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>




@endsection