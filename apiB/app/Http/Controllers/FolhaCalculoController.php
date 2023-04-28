<?php

namespace App\Http\Controllers;

use App\Models\FolhaCalculada;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class FolhaCalculoController extends Controller
{

    private $funcionario;
    private $folhaCalculada;

    public function __construct(FolhaCalculada $folhaCalculada, Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
        $this->folhaCalculada = $folhaCalculada;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->folhaCalculada->with('funcionario')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request->all();

        try {
            foreach ($content as $folha) {

                $funcionario = $this->funcionario->where('cpf', $folha['folha']['funcionario']['cpf'])->first();

                if (!$funcionario) {
                    $funcionario = $this->funcionario->create([
                        'nome' => $folha['folha']['funcionario']['nome'],
                        'cpf' => $folha['folha']['funcionario']['cpf'],
                        'created_at' => date('Y-m-d H:m:s')
                    ]);
                }

                $create = $this->folhaCalculada->create([
                    'mes' => $folha['folha']['mes'],
                    'ano' => $folha['folha']['ano'],
                    'horas' => $folha['folha']['horas'],
                    'valor' => $folha['folha']['valor'],
                    'bruto' => $folha['folha']['bruto'],
                    'irrf' => $folha['folha']['irrf'],
                    'inss' => $folha['folha']['inss'],
                    'fgts' => $folha['folha']['fgts'],
                    'liquido' => $folha['folha']['liquido'],
                    'id_funcionario' => $funcionario->id,
                    'created_at' => date('Y-m-d H:m:s')
                ]);

                $retorno[] = $create;
            }

            return response()->json($this->folhaCalculada->orderBy('id', 'desc')->get(), 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }
}
