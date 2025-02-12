@extends('layouts.sidebar')

@section('content')
    <div class="container mt-4">
        <h1>Portarias</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('portarias.create') }}" class="btn btn-success mb-3">Nova Portaria</a>

        <table class="table" id="portariasTable">
            <thead>
                <tr>
                    <th>Equipe INE</th>
                    <th>Equipe Nome</th>
                    <th>Tipologia da Equipe</th>
                    <th>Portaria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portarias as $portaria)
                    <tr>
                        <td>{{ $portaria->INE }}</td>
                        <td>{{ $portaria->equi_nome ?: 'Não disponível' }}</td>
                        <td>{{ $portaria->TIPO }}</td>
                        <td>{{ $portaria->PRT_MS }}</td>
                        <td>
                        <a href="{{ route('portarias.edit', $portaria->INE) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('portarias.destroy', $portaria->INE) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#portariasTable').DataTable();
        });
    </script>
@endsection
