<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index(){

        $relatorio = DB::table('fornecedors as fr')
                        ->join('produtos as pd', 'pd.fornecedor_id', '=', 'fr.id')
                        ->select('fr.nome as fornecedor', 'pd.nome as produto', 'pd.valor as valor')
                        ->get();

        return view("home", ["relatorio" => $relatorio]);
    }
}
