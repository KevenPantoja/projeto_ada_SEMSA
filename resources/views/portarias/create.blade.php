@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <h1 class="mt-4">Criar Portaria</h1>

        <!-- Formulário de Criação da Portaria -->
        <form action="{{ route('portarias.store') }}" method="POST">
            @csrf

            <!-- Caixa de seleção para Equipe -->
            <div class="mb-3">
                <label for="INE" class="form-label">Equipe</label>
                <select class="form-control" id="INE" name="INE" required>
                    <option value="">Selecione uma equipe</option>
                    @foreach($equipes as $equipe)
                        <option value="{{ $equipe }}">{{ $equipe }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Caixa de texto para o Tipo de Portaria -->
            <div class="mb-3">
                <label for="TIPO" class="form-label">Tipologia da Portaria</label>
                <input type="text" class="form-control" id="TIPO" name="TIPO" value="{{ old('TIPO') }}" required>
            </div>

            <!-- Caixa de texto para Portaria -->
            <div class="mb-3">
                <label for="prt_informatiza" class="form-label">Portaria</label>
                <input type="text" class="form-control" id="PRT_MS" name="PRT_MS" value="{{ old('PRT_MS') }}" required>
            </div>

            <!-- Status da Portaria -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Ativada</option>
                    <option value="0">Desativada</option>
                </select>
            </div>

            <!-- Botões -->
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('portarias.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
@endsection

