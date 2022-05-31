<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class MasterApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index() {
        $data = $this->model->all();
        //Paginacao
        //$data = $this->model->paginate(10);
        return response()->json($data);
    }

    public function store(Request $request) {
        $this->validate($request, $this->model->rules());
        $dataForm = $request->all();

        if ($request->hasFile($this->fieldImage) && $request->file($this->fieldImage)->isValid()) {
            $extension = $request->file($this->fieldImage)->extension();
            $name = uniqid(date('His'));

            $nameFile = "$name.$extension";
            $upload = Image::make($dataForm[$this->fieldImage])->resize($this->width, $this->height)->save(storage_path("app/public/$this->pathImage/$nameFile", 70));

            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            } else {
                $dataForm[$this->fieldImage] = $nameFile;
            }
        }

        $data = $this->model->create($dataForm);

        return response()->json($data, 201);
    }

    public function show($id) {
        if (!$data = $this->model->find($id)) {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        } else {
            return response()->json($data);
        }
    }

    public function update(Request $request, $id) {
        if (!$data = $this->model->find($id)) {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        }

        $this->validate($request, $this->model->rules());
        $dataForm = $request->all();

        if ($request->hasFile($this->fieldImage) && $request->file($this->fieldImage)->isValid()) {

            $arquivo = $this->model->arquivo($id);
            if ($arquivo) {
                Storage::disk('public')->delete("/$this->pathImage/$arquivo");
            }

            $extension = $request->file($this->fieldImage)->extension();
            $name = uniqid(date('His'));

            $nameFile = "$name.$extension";
            $upload = Image::make($dataForm[$this->fieldImage])->resize($this->width, $this->height)->save(storage_path("app/public/$this->pathImage/$nameFile", 70));

            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            } else {
                $dataForm[$this->fieldImage] = $nameFile;
            }
        }

        $data->update($dataForm);

        return response()->json($data, 201);
    }

    public function destroy($id) {
        if ($data = $this->model->find($id)) {
            if (method_exists($this->model, 'arquivo')) {
                Storage::disk('public')->delete("/{$this->pathImage}/{$this->model->arquivo($id)}");
            }
            $data->delete();
            return response()->json(['success' => "Registro $id deletado com sucesso!"]);
        } else {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        }
    }
}
