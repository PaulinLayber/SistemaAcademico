<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                @auth


                    <a class="navbar-brand" href="{{ url('/dashboard') }}">Sistema Acadêmico</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            @can('isProfessor')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('usuarios.lista') }}">Usuários</a>
                                </li>
                            @endcan
                            @can('isAdmin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('professor.disciplinasPage') }}">Disciplinas</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('professor.turmasPage') }}">Turmas</a>
                                </li>
                            @endcan
                            @can('isAluno')
                                <a href="{{ route('aluno.notaUsuario') }}" class="nav-link">Nota do aluno</a>
                            @endcan

                        </ul>
                @endauth
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.logout') }}">
                                    Logout ({{ Auth::user()->nome }})
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.register') }}">Registrar</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header <main class="container py-5 flex-grow-1 d-flex align-items-center justify-content-center">
    @yield('content')
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //script para exibir mensagens de alerta usando SweetAlert2
        document.addEventListener('DOMContentLoaded', function () {

            // --- 1. MENSAGEM DE SUCESSO ---
            @if(Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

                // --- 2. ERROS DE VALIDAÇÃO ---
                @if ($errors->any())
                    var errorsHtml = '<ul>';
                    @foreach ($errors->all() as $error)
                        errorsHtml += '<li>{{ $error }}</li>';
                    @endforeach
                    errorsHtml += '</ul>';

                    Swal.fire({
                        icon: 'error',
                        title: 'Ops! Ocorreram erros:',
                        html: errorsHtml,
                        showConfirmButton: true
                    });
                @endif

            // --- 3. MENSAGEM DE ERRO GERAL ---
            @if(Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: '{{ Session::get('error') }}',
                    showConfirmButton: true
                });
            @endif
    });
    </script>

    <footer class="bg-light py-3 mt-auto">
        <div class="container text-center">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
                crossorigin="anonymous"></script>
            <p class="mb-0 text-muted">&copy; {{ date('Y') }} Sistema Acadêmico. Todos os direitos reservados.</p>
            @yield('footer')
        </div>
    </footer>

</body>

</html>