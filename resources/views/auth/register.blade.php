@extends('layout.main')
@section('title', 'Registro de Usuário')

@section('content')
    <div class="row justify-content-center">
        <div class="col-auto">
             <div class="card shadow-lg p-4 rounded" style="max-width: 450px; width: 100%;">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Registrar</h1>
                    
                    <form method="POST" action="{{ route('auth.register') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar senha:</label>
                            <input type="password" id="confirm_password" name="password_confirmation" class="form-control" required> 
                        </div>
                        
                        <div class="mb-4">
                            <label for="role" class="form-label">Tipo de Usuário:</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="">Selecione...</option>
                                <option value="aluno">Aluno</option>
                                <option value="professor">Professor</option>
                                <option value="admin">Administrador</option> 
                            </select>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                        
                        <p class="text-center mt-3">
                            <a href="{{ route('auth.login') }}" class="text-decoration-none">Já possui uma conta? Faça Login!</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection