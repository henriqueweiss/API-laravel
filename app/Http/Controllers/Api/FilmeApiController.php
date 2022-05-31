<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\MasterApiController;
use Illuminate\Http\Request;
use App\Models\Filme;

class FilmeApiController extends MasterApiController
{
    protected $model;
    protected $pathImage = 'filmes';
    protected $fieldImage = 'capa';
    protected $width = 800;
    protected $height = 533;

    public function __construct(Filme $filme, Request $request) {
        $this->model = $filme;
        $this->request = $request;
    }
}
