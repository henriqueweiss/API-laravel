<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\MasterApiController;
use Illuminate\Http\Request;
use App\Models\Telefone;

class TelefoneApiController extends MasterApiController
{
    protected $model;
    protected $pathImage;
    protected $fieldImage;

    public function __construct(Telefone $telefone, Request $request) {
        $this->model = $telefone;
        $this->request = $request;
    }

    public function cliente($id) {
        if (!$data = $this->model->with('cliente')->find($id)) {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        } else {
            return response()->json($data);
        }
    }
}
