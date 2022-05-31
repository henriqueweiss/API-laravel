<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Documento;
use App\Models\Telefone;
use App\Models\Filme;

class Cliente extends Model
{
    protected $fillable = [
        'name',
        'image',
        //'cpf_cnpj'
    ];

    public function rules(){
        return [
            'name' => 'required',
            'image' => 'image',
            //'cpf_cnpj' => 'required|unique:clientes'
        ];
    }

    public function arquivo($id) {
        $data = $this->find($id);
        return $data->image;
    }

    public function documento() {
        return $this->hasOne(Documento::class, 'cliente_id', 'id');
    }

    public function telefone() {
        return $this->hasMany(Telefone::class, 'cliente_id', 'id');
    }

    public function filmesAlugados() {
        return $this->belongsToMany(Filme::class, 'locacaos');
    }
}
