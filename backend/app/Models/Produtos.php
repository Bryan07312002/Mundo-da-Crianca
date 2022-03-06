<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = ['name','description','dimensions','line'];

    public function rules(){
        return [
            "name"=>"required|unique:produtos,name,".$this->id."|min:3|max:100",
        ];
    }

    public function feedback(){
        return [
            "name.required" => "O campo nome é obrigatorio",
            "name.unique" => "Este nome ja existe no banco de dados",
            "name.min" => "O nome deve ter no mínimo 3 letras",
            "name.max" => "O nome deve ter no máximo 100 letras",
        ];
    }

    public function Images(){
        //Uma marca possui muitas Imagens
        return $this->hasMany('App\Models\images');
    }
}
