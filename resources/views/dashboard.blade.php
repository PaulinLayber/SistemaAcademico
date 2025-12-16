@extends('layout.main')
@section('title', 'Dashboard')
@section('content')

<div class="container-fluid py-4">
    <h1 class="mb-4">Dashboard</h1>
    
    <div class="row">
        <!-- Card de Alunos -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-primary shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                            <i class="fas fa-user-graduate fa-3x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-muted mb-1">Total de Alunos</h5>
                            <h2 class="mb-0">{{ $alunos ?? 0 }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('usuarios.lista') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-list me-1"></i> Ver lista de alunos
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-primary bg-opacity-10 border-0">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> Alunos cadastrados no sistema
                    </small>
                </div>
            </div>
        </div>

        <!-- Card de Professores -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-warning shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                            <i class="fas fa-chalkboard-teacher fa-3x text-warning"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-muted mb-1">Total de Professores</h5>
                            <h2 class="mb-0">{{ $professores ?? 0 }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-eye me-1"></i> Ver professores
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-warning bg-opacity-10 border-0">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> Professores ativos no sistema
                    </small>
                </div>
            </div>
        </div>

        <!-- Card de Turmas -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-success shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                            <i class="fas fa-users fa-3x text-success"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-muted mb-1">Total de Turmas</h5>
                            <h2 class="mb-0">{{ $turmas ?? 0 }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('professor.turmasPage') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-list me-1"></i> Ver turmas
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-success bg-opacity-10 border-0">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> Turmas cadastradas
                    </small>
                </div>
            </div>
        </div>

        <!-- Card de Disciplinas -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-info shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded me-3">
                            <i class="fas fa-book fa-3x text-info"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-muted mb-1">Total de Disciplinas</h5>
                            <h2 class="mb-0">{{ $disciplinas ?? 0 }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('professor.disciplinasPage') }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-list me-1"></i> Ver disciplinas
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-info bg-opacity-10 border-0">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> Disciplinas disponíveis
                    </small>
                </div>
            </div>
        </div>

        <!-- Card de Notas -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-danger shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                            <i class="fas fa-chart-line fa-3x text-danger"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-muted mb-1">Média Geral</h5>
                            <h2 class="mb-0">{{ $mediaGeral ?? 'N/A' }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        @if(auth()->user()->role === 'aluno')
                            <a href="{{ route('aluno.notaUsuario') }}" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-chart-bar me-1"></i> Ver minhas notas
                            </a>
                        @else
                            <a href="#" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-chart-bar me-1"></i> Ver estatísticas
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-footer bg-danger bg-opacity-10 border-0">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> 
                        @if(auth()->user()->role === 'aluno')
                            Sua média geral
                        @else
                            Média geral dos alunos
                        @endif
                    </small>
                </div>
            </div>
        </div>

        <!-- Card de Último Acesso -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-secondary shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-secondary bg-opacity-10 p-3 rounded me-3">
                            <i class="fas fa-clock fa-3x text-secondary"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-muted mb-1">Último Acesso</h5>
                            <h6 class="mb-0">{{ auth()->user()->updated_at->format('d/m/Y H:i') ?? 'N/A' }}</h6>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : (auth()->user()->role === 'professor' ? 'warning' : 'primary') }}">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                        <span class="badge bg-success ms-2">
                            <i class="fas fa-circle me-1"></i> Online
                        </span>
                    </div>
                </div>
                <div class="card-footer bg-secondary bg-opacity-10 border-0">
                    <small class="text-muted">
                        <i class="fas fa-user me-1"></i> {{ auth()->user()->nome }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Ações Rápidas -->
    @if(auth()->user()->role === 'professor' || auth()->user()->role === 'admin')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(auth()->user()->role === 'admin')
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('professor.turmaPage') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus-circle me-2"></i>Nova Turma
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('professor.disciplinaPage') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-book-medical me-2"></i>Nova Disciplina
                            </a>
                        </div>
                        @endif
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('usuarios.lista') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-user-edit me-2"></i>Avaliar Alunos
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('aluno.notaUsuario') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-chart-pie me-2"></i>Ver Notas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('footer')
<!-- Adicione Font Awesome para os ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .card {
        border-radius: 10px;
        transition: transform 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-title {
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    h2 {
        font-weight: 700;
        color: #2c3e50;
    }
    .bg-opacity-10 {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
    }
</style>
@endsection