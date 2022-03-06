<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = ['image','product_id'];

    public function rules(){
        return [
            "image" => "required|file|mimes:png,jpeg,jpg,pdf,svg",
        ];
    }

    public function feedback(){
        return [
            "image.required" => "O campo imagem é obrigatorio",
            "image.file" => "O campo imagem deve ser uma imagem",
            "image.mimes" => "O campo imagem png, jpg, jpeg, pdf, svg",
        ] ;
    }
}
