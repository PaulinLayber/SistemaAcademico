<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
</head>

<body>
    
    <header>
    <nav style="background-color: #333; padding: 10px 20px;">
        <ul style="list-style: none; margin: 0; padding: 0; display: flex;">
            
            <li style="margin-right: 20px;">
                <a href="{{ url('/dashboard') }}" style="color: white; text-decoration: none;">Dashboard</a>
            </li>

            <li style="margin-right: 20px;">
                <a href="{{ url('/usuarios') }}" style="color: white; text-decoration: none;">Usuários</a>
            </li>
            
            <li style="margin-right: 20px;">
                <a href="{{ url('/disciplinas') }}" style="color: white; text-decoration: none;">Disciplinas</a>
            </li>
            
            <li style="margin-right: 20px;">
                <a href="{{ url('/turmas') }}" style="color: white; text-decoration: none;">Turmas/Matrículas</a>
            </li>
            
            <li style="margin-left: auto; margin-right: 10px;">
                <a href="{{ route('auth.login') }}" style="color: white; text-decoration: none;">Login</a>
            </li>
            <li>
                <a href="{{ route('auth.register') }}" style="color: white; text-decoration: none;">Registrar</a>
            </li>
            
        </ul>
    </nav>
</header>

@yield('content')
    
    @yield('content')

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

    <footer>
        <p>&copy; {{ date('Y') }} Sistema Acadêmico. Todos os direitos reservados.</p>
        @yield('footer')
    </footer>
    
</body>
</html>