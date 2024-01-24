<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Peliculas;

class DemoController extends Controller
{

    public function demo(){

        $parametros_peli = 'discover/movie?include_adult=false&include_video=false&language=es-CO&page=1&sort_by=popularity.desc';

        $data = Http::asJson()
        ->get(config('services.tmdb.endpoint').$parametros_peli .'&api_key='.config('services.tmdb.api'));

        return view('demo', compact('data'));
    } 

    /* public function demo(){

        $tmdb_id = 436270; //Black Adam (2022) Movie TMDB ID

        $data = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/'.$tmdb_id. '?api_key='.config('services.tmdb.api'));
            
        return view('demo',compact('data'));
    } */

    public function get()
    {
        try {
            $data = Peliculas::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $data['nombre'] = $request['nombre'];
            $data['genero'] = $request['genero'];
            $data['lenguaje'] = $request['lenguaje'];
            $data['titulo_original'] = $request['titulo_original'];
            $data['resumen'] = $request['resumen'];
            $data['poster'] = $request['poster'];
            $res = Peliculas::create($data);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getById($id)
    {
        try {
            $data = Peliculas::find($id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data['nombre'] = $request['nombre'];
            $data['genero'] = $request['genero'];
            $data['lenguaje'] = $request['lenguaje'];
            $data['titulo_original'] = $request['titulo_original'];
            $data['resumen'] = $request['resumen'];
            $data['poster'] = $request['poster'];
            Peliculas::find($id)->update($data);
            $res = Peliculas::find($id);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $res = Peliculas::find($id)->delete();
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

}