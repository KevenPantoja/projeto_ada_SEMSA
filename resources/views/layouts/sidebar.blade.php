<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap-v3.3.3/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap-v3.3.3/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/chart4.4.7.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Arquivos de configuração do DataTable -->
    <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jszip3.1.3/jszip.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/spinner.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <header class="header d-flex" style="position: sticky; top: 0;">
        <button type="button" class="btn" data-bs-toggle="button" id="toggle-btn"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg></button>
        <div class="mx-auto my-auto text-center">
            <a href="/" class="alert-link">
                <img src="{{ asset('img/logo_tema.png') }}" class="img-fluid rounded-top" id="logoada"
                    alt="ADA" />
            </a>
        </div>
    </header>
    <div class="d-flex">
        <div class="sidebar text-white p-3" id="sidebar">
            <div class="logo text-center mb-3 d-flex align-items-center justify-content-center">
                <a href="/" class="d-flex align-items-center text-decoration-none text-reset">
                    <img src="{{ asset('img/icon-ada.png') }}" alt="Ícone Sistema ADA"
                         style="width: 24px; height: 24px; margin-right: 8px;" />
                    <span class="nav-link">Sistema ADA</span>
                </a>
            </div>

            <hr>
            <nav class="nav flex-col menu">
                <a class="nav-link text-white show-spinner" href="/principal"><i
                        class="bi bi-house-door-fill"></i><span>Início</span></a>
                <a class="nav-link text-white show-spinner" href="/cenario"><i
                        class="bi bi-people-fill"></i><span>Cenário de
                        Equipes</span></a>
                <a class="nav-link text-white show-spinner" href="/listarProfissionais"><i
                        class="bi bi-person-workspace"></i><span>Profissionais</span></a>
                <a class="nav-link text-white show-spinner" href="/informacoes"><i
                        class="bi bi-clipboard2-data-fill"></i><span>Informações Gerais</span></a>
                {{-- <a class="nav-link text-white show-spinner" href="{{ route('portarias.index') }}"><i
                    class="bi bi-clipboard2-data-fill"></i><span>Portarias</span>
                </a> --}}
                <a class="nav-link text-white show-spinner" href="http://127.0.0.1:8000/arquivos"><i
                        class="bi bi-clipboard2-data-fill"></i><span>Legislações CNES</span></a>

                <div class="footer flex-col">
                    <div class="mb-2">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link text-white show-spinner" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bi bi-person"></i>{{ $user->name }}</a>
                                <ul class="dropdown-menu  dropdown-menu-end">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <a href="/logout" class="dropdown-item" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            Sair
                                        </a>
                                    </form>
                                </ul>
                            </li>
                        @endauth
                    </div>
                    <div class="mb-2">
                        <img src="{{ asset('img/logo.svg') }}" class="img rounded-top" id="logodid"
                            alt="didlogo" /><span>© 2024</span>
                    </div>
                    <p>Diretoria de Inteligência de Dados - SEMSA</p>
                </div>
        </div>
        <main class="content">
            <div id="spinner-overlay" class="hidden text-center">
                <strong class="fs-1 text-warning">Carregando
                    {{-- <div class="spinner"></div> --}}
                    <div class="spinners-grow">
                        <div class="sphere sphere-1"></div>
                        <div class="sphere sphere-2"></div>
                        <div class="sphere sphere-3"></div>
                    </div>
                </strong>
            </div>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/spinner.js') }}"></script>

</body>

</html>
