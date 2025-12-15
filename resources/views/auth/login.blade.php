@extends('layout.main');
@section('title', 'Login Page')
@section('content')
    <h1>Login</h1>
    <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
        <a href="{{ route('registerPage') }}">Não possui uma conta? Registre-se!</a>
    </form>
@endsection

