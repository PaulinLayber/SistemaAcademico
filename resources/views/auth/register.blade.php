@extends('layout.main')
@section('title', 'Login Page')
@section('content')
    <h1>Register</h1>
    <form method="POST" action="{{ route('auth.register') }}">
        @csrf
        <label for="name">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="confirm_password">Confirmar senha:</label>
        <input type="password" id="confirm_password" name="confirm_password" required> 
        <br>
        <label for="role">Tipo de Usuário:</label>
        <select id="role" name="role" required>
            <option value="">Selecione...</option>
            <option value="aluno">Aluno</option>
            <option value="professor">Professor</option>
            <option value="admin">Administrador</option> 
        </select>

        <button type="submit">Registrar</button>
    </form>
@endsection

@section('footer')

@endsection

