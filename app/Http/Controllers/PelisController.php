<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Peliculas;

class PelisController extends Controller
{

    public function home(){

        $parametros_peli = 'discover/movie?include_adult=false&include_video=false&language=es-CO&page=1&sort_by=popularity.desc';

        $data = Http::asJson()
        ->get(config('services.tmdb.endpoint').$parametros_peli .'&api_key='.config('services.tmdb.api'));

        $parametros_genero = 'genre/movie/list?language=es-CO';

        $lista_de_generos = Http::asJson()
        ->get(config('services.tmdb.endpoint').$parametros_genero .'&api_key='.config('services.tmdb.api'));

        return view('home', compact('data', 'lista_de_generos'));
    }
    
    public function favoritas() {
        return view('favoritas');
    }

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