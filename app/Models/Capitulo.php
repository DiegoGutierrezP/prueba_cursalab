<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }
}
