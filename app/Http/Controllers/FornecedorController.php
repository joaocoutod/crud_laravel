<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index(){

        $fornecedores = Fornecedor::all();

        return view('fornecedor', ['fornecedores' => $fornecedores]);
    }


    //INSERTE
    public function insert_fornecedor(Request $request){

        if(!empty($request->all())){
            if(Fornecedor::where('nome', $request->nome)->First()){
                return back()->with('error', 'Ja existe um fornecedor com o mesmo nome.');
            }else{

                $fornecedor = new Fornecedor;
                $fornecedor->nome = $request->nome;

                if($fornecedor->save()){
                    return back()->with('success', 'Fornecedor criado com sucesso!');
                }else {
                    return back()->with('error', 'Error ao criar fornecedor!');
                }
                

            }
        }else{
            return back()->with('error', 'Error ao inserir fornecedor.');
        }

    }

    //UPDATE
    public function update_fornecedor(Request $request){
        if(!empty($request->all())){
    
            $update = Fornecedor::where('id', $request->id)
                            ->update([
                                'nome'=> $request->nome
                            ]);

            if ($update) {
                return back()->with('success', "O fornecedor ($request->nome) foi alterado com sucesso ");
            }else {
                return back()->with('error', "Error ao atualizar o fornecedor ($request->id)");
            }
        }
    }


    //DELETE
    public function delete_fornecedor($id){

        if(Fornecedor::where("id", $id)->delete()){
            return back()->with('success', "Deletou o fornecedor $id");
        }else{
            return back()->with('error', "Error ao deletar fornecedor $id");
        }
       
    }
}
