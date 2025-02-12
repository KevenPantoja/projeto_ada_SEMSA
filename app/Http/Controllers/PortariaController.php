<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Portaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class PortariaController extends Controller
{
    // Exibir a lista de portarias
    public function index()
    {
        // Usando Eloquent para buscar as portarias e equipes
        $portarias = Portaria::join('tb_dim_equipe AS equi', 'ine_prt_homolog.INE', '=', 'equi.equi_ine')
                             ->select('ine_prt_homolog.INE', 'ine_prt_homolog.IDENTIFICACAO', 'equi.equi_nome', 'ine_prt_homolog.TIPO', 'ine_prt_homolog.PRT_MS')
                             ->get();

        return view('portarias.index', compact('portarias'));
    }

    // Exibir o formulário de criação
    public function create()
    {
        // Obtendo equipes e tipos distintos para o formulário
        $equipes = Portaria::whereNotNull('INE')
                           ->where('INE', '!=', '')
                           ->distinct()->pluck('INE');

        $tipos = Portaria::whereNotNull('TIPO')
                         ->where('TIPO', '!=', '')
                         ->distinct()->pluck('TIPO');
        
        return view('portarias.create', compact('equipes', 'tipos'));
    }

    // Salvar uma nova portaria
    public function store(Request $request)
    {
        Log::info('Dados recebidos no store:', $request->all());
        // Validação dos dados do formulário
        $request->validate([
            'INE' => 'required|string|max:255',
            'TIPO' => 'required|string|max:255',
            'PRT_MS' => 'required|string|max:255',
            'status' => 'required|in:0,1', // Validando status (0 ou 1)
        ]);
    
        try {
            // Criando a nova portaria
            Portaria::create([
                'INE' => $request->INE,
                'TIPO' => $request->TIPO,
                'PRT_MS' => $request->PRT_MS,
                'status' => $request->status, // 'ativada' ou 'desativada'
            ]);
    
            // Redireciona para a lista de portarias
            return redirect()->route('portarias.index')->with('success', 'Portaria criada com sucesso!');
        } catch (\Exception $e) {
            // Log de erro em caso de falha
            Log::error("Erro ao criar portaria: " . $e->getMessage());
            return redirect()->route('portarias.index')->with('error', 'Erro ao criar a portaria.');
        }
    }
    
    // Exibir o formulário de edição
    public function edit($ine)
{
    try {
        // Buscar a portaria pelo 'INE'
        $portaria = Portaria::where('INE', $ine)->firstOrFail();

        // Forçar o status para "Homologada" (1)
        $portaria->status = 1;

        // Obter o nome da equipe relacionada ao INE
        $equipeNome = DB::table('tb_dim_equipe')
                        ->where('equi_ine', $ine)
                        ->value('equi_nome'); // Retorna o nome da equipe

        // Obter todos os INEs das equipes
        $equipes = DB::table('tb_dim_equipe')->pluck('equi_nome', 'equi_ine');

        // Obter todos os INEs das portarias (excluindo os valores nulos ou vazios)
        $inePortarias = Portaria::whereNotNull('INE')->where('INE', '!=', '')->distinct()->pluck('INE');

        // Obter tipos de portaria
        $tipos = Portaria::whereNotNull('TIPO')->where('TIPO', '!=', '')
                         ->distinct()->pluck('TIPO');

        // Passar dados para a view
        return view('portarias.edit', compact('portaria', 'equipes', 'inePortarias', 'tipos', 'equipeNome'));

    } catch (\Exception $e) {
        Log::error("Erro ao carregar portaria para edição: " . $e->getMessage());
        return redirect()->route('portarias.index')->with('error', 'Portaria não encontrada.');
    }
}


    // Atualizar a portaria
    public function update(Request $request, $ine)
    {
        // Validação dos dados de entrada
        $portaria = Portaria::where('INE', $ine)->firstOrFail();
        
        $request->validate([
            'INE' => 'required|string|max:255',
            'TIPO' => 'required|string|max:255',
            'PRT_MS' => 'required|string|max:255',
            'status' => 'required|in:0,1', // Validando o status (0 ou 1)
        ]);
        
        try {
            // Buscar a portaria pelo 'INE'
            $portaria = Portaria::where('INE', $ine)->firstOrFail();

            // Atualizar os dados da portaria
            $portaria->update([
                'INE' => $request->INE,
                'TIPO' => $request->TIPO,
                'PRT_MS' => $request->PRT_MS,
                'status' => $request->status,
            ]);

            return redirect()->route('portarias.index')->with('success', 'Portaria atualizada com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar portaria: " . $e->getMessage());
            return redirect()->route('portarias.index')->with('error', 'Erro ao atualizar a portaria.');
        }
    }

    // Excluir uma portaria
    public function destroy($ine)
    {
        try {
            // Buscar a portaria pelo 'INE'
            $portaria = Portaria::where('INE', $ine)->firstOrFail();
            $portaria->delete();

            return redirect()->route('portarias.index')->with('success', 'Portaria excluída com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao excluir portaria: " . $e->getMessage());
            return redirect()->route('portarias.index')->with('error', 'Erro ao excluir a portaria.');
        }
    }

    public function teste()
    {
        // Obter todas as colunas da tabela
        $columns = Schema::getColumnListing('ine_prt_homolog');
    
        // Buscar todos os dados da tabela
        $data = DB::table('ine_prt_homolog')->get();
    
        return view('portarias.teste', compact('data', 'columns'));
    }
}
