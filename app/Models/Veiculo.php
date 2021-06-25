<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;
    protected $fillable = ['modelo_id', 'placa', 'disponivel', 'km','ano','descricao', 'vendido'];

    public function rules(){
        return [
            'modelo_id' => 'exists:modelos,id',
            'placa' => 'required',
            'disponivel' => 'required',
            'km' => 'required',
            'ano' => 'required',
            'descricao' => 'required',
            'vendido' => 'required|boolean'
        ];
    }
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
}
