<?php

namespace App\Http\Controllers\ImportExport;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\Http\Controllers\Controller;
use App\Repositories\ImportFansRepository;


class ImportTorcedoresController extends Controller
{

    /**
     * @var string
     */
    protected $dataRepository;

    /**
     * TorcedorRepository constructor.
     * @param $dataRepository
     */
    public function __construct(ImportFansRepository $dataRepository)
    {
        $this->dataRepository = $dataRepository;
    }

    public function index(){

        return view('site.import.index');
    }


    public function import(Request $request)
    {
        // Faz verificações para saber se está no formato correto.
        $list = $this->dataRepository->verifications($request);

        if($list){
            foreach($list as $row){

                //Limpa os campos
                $row = $this->dataRepository->replace($row);

                // Cria ou atualiza as linhas
                $this->dataRepository->creatUpdateList($row);
            }

            Session::flash('msg', 'Seu arquivo foi importado e os dados atualizados com sucesso.');
            return redirect('/importar-torcedores');
        }

        Session::flash('msgErro', 'Arquivo não compativel. Faça upload somente de arquivos com a extensão xml ou xlsx');
        return redirect('/importar-torcedores');
    }

}
