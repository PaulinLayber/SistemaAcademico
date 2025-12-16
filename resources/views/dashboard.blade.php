@extends('layout.main')
@section('title', 'Dashboard')
@section('content')

<div class="container-fluid py-4">
    <h1 class="mb-4 text-primary border-bottom border-primary pb-2">📊 Painel de Controle Acadêmico</h1>
    
    <div class="row g-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-start border-5 border-primary shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-user-graduate fa-2x text-primary"></i>
                        </div>
                        <div>
                            <p class="card-title text-uppercase text-muted mb-0">Total de Alunos</p>
                            <h2 class="mb-0 text-primary">{{ $alunos ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                    <a href="{{ route('usuarios.lista') }}" class="text-primary text-decoration-none small">
                        <i class="fas fa-list me-1"></i> Detalhes dos Alunos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-start border-5 border-warning shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-chalkboard-teacher fa-2x text-warning"></i>
                        </div>
                        <div>
                            <p class="card-title text-uppercase text-muted mb-0">Total de Professores</p>
                            <h2 class="mb-0 text-warning">{{ $professores ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                    <a href="#" class="text-warning text-decoration-none small">
                        <i class="fas fa-eye me-1"></i> Ver Professores
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-start border-5 border-success shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                        <div>
                            <p class="card-title text-uppercase text-muted mb-0">Total de Turmas</p>
                            <h2 class="mb-0 text-success">{{ $turmas ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                    <a href="{{ route('professor.turmasPage') }}" class="text-success text-decoration-none small">
                        <i class="fas fa-list me-1"></i> Gerenciar Turmas
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-start border-5 border-info shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-book-open fa-2x text-info"></i>
                        </div>
                        <div>
                            <p class="card-title text-uppercase text-muted mb-0">Total de Disciplinas</p>
                            <h2 class="mb-0 text-info">{{ $disciplinas ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                    <a href="{{ route('professor.disciplinasPage') }}" class="text-info text-decoration-none small">
                        <i class="fas fa-list me-1"></i> Ver Disciplinas
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-6 mt-4">
            <div class="card border-start border-5 border-secondary shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-clock fa-2x text-secondary"></i>
                            </div>
                            <div>
                                <p class="card-title text-uppercase text-muted mb-0">Último Acesso</p>
                                <h4 class="mb-0">{{ auth()->user()->updated_at->format('d/m/Y H:i') ?? 'N/A' }}</h4>
                            </div>
                        </div>
                        <div>
                            <span class="badge rounded-pill bg-{{ auth()->user()->role === 'admin' ? 'danger' : (auth()->user()->role === 'professor' ? 'warning' : 'primary') }} me-2">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                            <span class="badge rounded-pill bg-success">
                                <i class="fas fa-circle me-1 small"></i> Online
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                    <small class="text-muted">
                        <i class="fas fa-user me-1"></i> Usuário: **{{ auth()->user()->nome }}**
                    </small>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="card shadow h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2 text-dark"></i> Área de Relatórios</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <p class="text-muted mb-0">Adicione aqui seus gráficos e relatórios! (Ex: Chart.js)</p>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->role === 'professor' || auth()->user()->role === 'admin')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow border-dark">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @if(auth()->user()->role === 'admin')
                        <div class="col-6 col-md-3">
                            <a href="{{ route('professor.turmaPage') }}" class="btn btn-primary w-100 btn-lg d-flex flex-column align-items-center py-3">
                                <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                <span>Nova Turma</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('professor.disciplinaPage') }}" class="btn btn-success w-100 btn-lg d-flex flex-column align-items-center py-3">
                                <i class="fas fa-book-medical fa-2x mb-2"></i>
                                <span>Nova Disciplina</span>
                            </a>
                        </div>
                        @endif
                        <div class="col-6 col-md-3">
                            <a href="{{ route('usuarios.lista') }}" class="btn btn-warning w-100 btn-lg d-flex flex-column align-items-center py-3">
                                <i class="fas fa-user-edit fa-2x mb-2"></i>
                                <span>Avaliar Alunos</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('aluno.notaUsuario') }}" class="btn btn-info w-100 btn-lg d-flex flex-column align-items-center py-3">
                                <i class="fas fa-chart-pie fa-2x mb-2"></i>
                                <span>Ver Notas</span>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Estilos do Dashboard */
    .card {
        border-radius: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden; /* Para garantir que o border-start fique contido */
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
    }
    .card-title {
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.8px;
    }
    h2 {
        font-weight: 800;
    }
    h4 {
        font-weight: 600;
    }
    .bg-opacity-10 {
        /* Para garantir que a cor seja usada (já estava lá, mas reconfirmando a classe) */
        /* Ex: background-color: rgba(var(--bs-primary-rgb), 0.1); */
    }
    .btn-lg span {
        font-size: 0.9rem;
        font-weight: 600;
    }
</style>
@endsection