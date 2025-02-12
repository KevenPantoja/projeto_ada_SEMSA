@extends('layouts.sidebar_legislacao_CNES') 

@section('title', 'ADA - LEGISLAÇÕES DO CNES') 

@section('content')

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Legislações CNES</h1>
        
        @if(count($files) > 0)
            <ul class="bg-white shadow-md rounded-lg p-4">
                @foreach($files as $file)
                    <li class="mb-2 border-b pb-2">
                        <!-- Alterando para usar a nova rota de exibição -->
                        <a href="{{ route('arquivos.show', ['file' => basename($file)]) }}" 
                           target="_blank" 
                           class="text-blue-500 hover:underline">
                            {{ basename($file) }}
                        </a>
                        <span class="text-gray-500 text-sm">({{ strtoupper($file->getExtension()) }})</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">Nenhum arquivo encontrado nos formatos permitidos.</p>
        @endif
    </div>
</body>

@endsection
