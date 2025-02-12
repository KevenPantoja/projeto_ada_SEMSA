<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\LogController;
use App\Models\Logs;

class ArquivosController extends Controller
{

    private $log;

    public function __construct( LogController $log )
    {
        $this->log = $log;
    }

    public function index()
{
    $this->log->setLog('Novo_ADA', 'Usuário acessou a aba Legislações CNES');

    // sempre que for alterar a pasta de leitura dos documetos da aba legislção CNES alterar nas function
    // $path = 'C:/Users/keven.prates/Documents/pasta_teste';

    $path = 'C:/Users/keven.prates/Documents/legislacao_CNES';
    
    $files = [];

    if (File::exists($path)) {

        logger("Diretório encontrado: $path");

        $allFiles = File::files($path);

        $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'csv'];
        $files = collect($allFiles)->filter(function ($file) use ($allowedExtensions) {
            return in_array($file->getExtension(), $allowedExtensions);
        });

        logger("Arquivos filtrados: " . $files->count());
    } else {
        logger("O diretório especificado não foi encontrado: $path");
    }

   
    return view('legislacao_CNES', ['files' => $files]);
}

    public function show($file)
    {
        // sempre que for alterar a pasta de leitura dos documetos da aba legislção CNES alterar nas function
        // $path = 'C:/Users/keven.prates/Documents/pasta_teste/' . $file;

        $path = 'C:/Users/keven.prates/Documents/legislacao_CNES/' . $file;

        // Verifica se o arquivo existe
        if (File::exists($path)) {
            // Retorna o arquivo para download ou visualização
            return response()->file($path);
        } else {
            // Se o arquivo não for encontrado, retorna um erro
            abort(404, 'Arquivo não encontrado.');
        }
    }

}
