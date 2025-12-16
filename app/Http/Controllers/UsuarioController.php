<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\NotaRequest;
use App\Models\Disciplina;
use App\Models\Nota;
use App\Models\Turma;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $request = $request->validated();
        $request['password'] = Hash::make($request['password']);
        Usuario::create($request);

        return redirect()->route('auth.loginPage')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated(); //
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $request->session()->regenerate();
        Auth::logout();

        return redirect()->route('auth.loginPage');
    }

    public function listarUsuarios(Request $request)
    {
        // Obter turma_id do request (query parameter)
        $turma_id = $request->get('turma_id');

        // Lista todos os alunos
        $usuarios = Usuario::where('role', 'aluno')->get();

        // Lista todas as turmas para o select do modal
        $turmas = Turma::all();

        return view('usuarios.usuarios', compact('usuarios', 'turmas', 'turma_id'));
    }

    public function salvarNota(NotaRequest $request)
    {
        $validated = $request->validated();

        // Verificar se o aluno existe
        $aluno = Usuario::where('id_usuario', $validated['aluno_id'])
            ->where('role', 'aluno')
            ->first();

        if (! $aluno) {
            return redirect()->back()
                ->withErrors(['aluno_id' => 'Aluno não encontrado.'])
                ->withInput();
        }

        // Verificar se a turma existe
        $turma = Turma::find($validated['turma_id']);
        if (! $turma) {
            return redirect()->back()
                ->withErrors(['turma_id' => 'Turma não encontrada.'])
                ->withInput();
        }

        // Verifica se já existe uma nota para esse aluno + turma
        $nota = Nota::where('aluno_id', $validated['aluno_id'])
            ->where('turma_id', $validated['turma_id'])
            ->first();

        if ($nota) {
            // Atualizar nota existente
            $nota->valor = $validated['valor'];
            $nota->save();
        } else {
            // Criar nova nota
            $nota = Nota::create([
                'aluno_id' => $validated['aluno_id'],
                'turma_id' => $validated['turma_id'],
                'valor' => $validated['valor'],
            ]);
        }

        // Redirecionar mantendo o filtro de turma
        $turma_atual = $request->input('turma_atual', null);

        if ($turma_atual) {
            return redirect()->route('usuarios.lista', ['turma_id' => $turma_atual])
                ->with('success', 'Nota salva com sucesso!');
        }

        return redirect()->back()->with('success', 'Nota salva com sucesso!');
    }
    public function notaUsuario(){
    // Carrega notas com turma e disciplina
    $notas = Nota::where('aluno_id', Auth::id())
                 ->with(['turma.disciplina']) // Carrega os relacionamentos
                 ->get();
    
    $usuario = Usuario::find(Auth::id());
    
    return view('usuarios.nota', compact('notas', 'usuario'));
}
}
