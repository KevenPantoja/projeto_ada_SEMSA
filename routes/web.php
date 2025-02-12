<?php

use App\Http\Controllers\AlertasController;
use App\Http\Controllers\CenarioequipeController;
use App\Http\Controllers\DadosContatoController;
use App\Http\Controllers\dadosequipeController;
use App\Http\Controllers\NovoAdaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnidadeSaudeController;
use App\Http\Controllers\DadosVulneraveisController;
use App\Http\Controllers\informacoesController;
use App\Models\Cenarioequipe;
use App\Http\Controllers\PortariaController;
use App\Http\Controllers\ArquivosController;

view()->composer('*.*', function($view) {
    $user = Auth()->user();
    $view -> with('user', $user);
});

Route::get('/', [NovoAdaController::class, 'index'])->middleware('auth');
Route::get('/index', [NovoAdaController::class, 'index'])->middleware('auth');
Route::get('/principal', [NovoAdaController::class, 'index'])->middleware('auth');

Route::get('/unidades-saude', [UnidadeSaudeController::class, 'index'])->middleware('auth');

// Route::get('/listarequipes', [dadosequipeController::class, 'listar']);

// Route::get('/painel', [dadosequipeController::class, 'relacao']);



Route::get('/paginaindex', function () {
    return view('paginaindex');
});

Route::get('/datatables', function () {
    return view('testedatatables');
});

Route::get('/relacaoContatos',[DadosContatoController::class,'relacaoContatos']);

Route::get('/dadosvulneraveis', [DadosVulneraveisController::class, 'dadosVulneraveis']);

Route::get('/painel',[CenarioequipeController::class,'index']);

Route::get('/cenario',[CenarioequipeController::class,'index'])->name('cenario')->middleware('auth');

Route::get('/listarProfissionais',[CenarioequipeController::class,'listaProfissionais'])->name('listaProfissionais')->middleware('auth');

Route::get('/getUnidades/{distrito}', [CenarioequipeController::class, 'getUnidades']);

Route::get('/profissionais/{equipe}/{competencia}',[CenarioequipeController::class,'showProfissionais'])->name('profissionais.show');

Route::get('/informacoes',[informacoesController::class,'informacoes'])->name('informacoes')->middleware('auth');
//Route::get('/informacoes/{competencia}',[informacoesController::class,'dadosESF']);

Route::get('/dadosEquipes', [informacoesController::class, 'dadosEquipes'])->name('dadosEquipes')->middleware('auth');

Route::get('/alertas', [AlertasController::class, 'enviarDados'])->name('alertas')->middleware('auth');

Route::post('/listaralertas', [AlertasController::class, 'receberDados'])->name('listarAlertas')->middleware('auth');

Route::get('/alertas-unidade', [AlertasController::class, 'alertasUnidade'])->name('alertasUnidade')->middleware('auth');

Route::get('/alertas-ocorrencias', [AlertasController::class, 'alertasOcorrencias'])->name('alertasOcorrencias')->middleware('auth');

Route::get('/acompanhamento', [AlertasController::class, 'acompanhamentoAlerta'])->name('alertasAcompanhamento')->middleware('auth');

// Route::get('/acompanhamento', function () {
//     return view('acompanhamento');
// })->name('acompanhamento');

Route::get('/testes', function () {
    return view('testes');
});



Route::get('portarias', [PortariaController::class, 'index'])->name('portarias.index');
Route::get('portarias/create', [PortariaController::class, 'create'])->name('portarias.create');
Route::post('portarias', [PortariaController::class, 'store'])->name('portarias.store');
Route::get('portarias/{INE}/edit', [PortariaController::class, 'edit'])->name('portarias.edit');
Route::put('portarias/{INE}', [PortariaController::class, 'update'])->name('portarias.update');
Route::delete('portarias/{INE}', [PortariaController::class, 'destroy'])->name('portarias.destroy');


Route::get('/portarias/teste', [PortariaController::class, 'teste'])->name('portarias.teste');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [NovoAdaController::class, 'index'])->middleware('auth');
});


//parte da legislação CNES -- keven
Route::get('/arquivos', [ArquivosController::class, 'index'])->name('arquivos.index')->middleware('auth');
Route::get('/arquivos/{file}', [ArquivosController::class, 'show'])->name('arquivos.show')->middleware('auth');

