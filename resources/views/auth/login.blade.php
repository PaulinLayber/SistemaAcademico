@extends('layout.main')
@section('title', 'Login Page')

@section('content')
    <div class="row w-100"> 
        <div class="col-sm-10 col-md-6 col-lg-4 mx-auto">
            
            <div class="card shadow-lg p-4 rounded">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Login</h1>
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        
                        <p class="text-center mt-3">
                            <a href="{{ route('registerPage') }}" class="text-decoration-none">Não possui uma conta? Registre-se!</a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection