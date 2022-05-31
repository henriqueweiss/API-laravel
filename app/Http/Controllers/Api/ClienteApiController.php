<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\MasterApiController;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteApiController extends MasterApiController
{
    protected $model;
    protected $pathImage = 'clientes';
    protected $fieldImage = 'image';
    protected $width = 177;
    protected $height = 236;
    protected $totalPage = 20;

    public function __construct(Cliente $cli, Request $request) {
        $this->model = $cli;
        $this->request = $request;
    }

    public function index() {
        //Paginacao
        $data = $this->model->paginate($this->totalPage);
        return response()->json($data);
    }    

    public function documento($id) {
        if (!$data = $this->model->with('documento')->find($id)) {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        } else {
            return response()->json($data);
        }
    }

    public function telefone($id) {
        if (!$data = $this->model->with('telefone')->find($id)) {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        } else {
            return response()->json($data);
        }
    }

    public function alugados($id) {
        if (!$data = $this->model->with('filmesAlugados')->find($id)) {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        } else {
            return response()->json($data);
        }
    }        
}
