<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Fornecedor;

class ProdutoController extends Controller{   

    public function index(){
    
        $produtos = Produto::all();
        $fornecedores = Fornecedor::all();

        return view('produtos', [
            'produtos' => $produtos,
            'fornecedores' => $fornecedores
        ]);

    }


    //INSERTE
    public function insert_product(Request $request){
        if(!empty($request->all())){

            //verifica se ja existe um produto com o mesmo nome
            if(Produto::where('nome', $request->nome)->First()){

                return back()->with('error', 'Ja existe um produto com o mesmo nome!');
            
            }else {
                
                $produto = new Produto;
                $produto->nome = $request->nome;
                $produto->valor = $request->valor;
                $produto->fornecedor_id = $request->fornecedor;
                $produto->save();

                return back()->with('success', "O produto ($request->nome) foi inserido com sucesso ");
            }
            
        }else{
            return back()->with('error', 'Error ao inserir produto');
        }

    }


    //UPDATE
    public function update_product(Request $request){
        if(!empty($request->all())){
    
            $update = Produto::where('id', $request->id)
                            ->update([
                                'nome'=> $request->nome, 
                                'valor' => $request->valor,
                                'fornecedor_id' => $request->fornecedor
                            ]);

            if ($update) {
                return back()->with('success', "O produto ($request->nome) foi alterado com sucesso ");
            }else {
                return back()->with('error', "Error ao atualizar o produto ($request->id)");
            }
            
        }
    }

    
    //DELETE
    public function delete_product($id){

        if(Produto::where("id", $id)->delete()){
            return back()->with('success', "Deletou o produto $id");
        }else{
            return back()->with('error', "Error ao deletar produto $id");
        }
       
    }
}
