<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    public function cursos_user(){
        try{

            $user = User::find(Auth()->user()->id);

            $cursos = $user->cursos->map(function($c){
                $c->rutaShow = route('show.curso',$c->id);
                return $c;
            });

            return response()->json([
                'status'=>true,
                'data'=>$cursos
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'msg'=>'Ocurrio un error '.$e->getMessage()
            ]);
        }
    }

    public function show($id_curso){

        $user = User::find(Auth()->user()->id);

        $curso = $user->cursos()->where('curso_id',$id_curso)->first();

        if(!$curso){
            return abort(404);
        }

        return view('show-curso');
    }

    public function get_curso($id_curso){
        try{

            $curso = Curso::with('capitulos')->find($id_curso);



            return response()->json([
                'status'=>true,
                'data'=>$curso
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'msg'=>'Ocurrio un error '.$e->getMessage()
            ]);
        }
    }
}
