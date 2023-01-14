@extends('layouts.main')

@section('title', 'Fornecedores')

@section('content')
<div class="container text-center p-3">
    <h1 class="text-muted display-5">Lista de Fornecedores</h1>
</div>

@if(session('success'))
    <div class="container alert alert-success text-center" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
<div class="container alert alert-danger text-center" role="alert">
    {{ session('error') }}
</div>
@endif

<div class="container  table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Nome</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach ($fornecedores as $fornecedor)
            <tr>
                <td class="text-center">{{$fornecedor->id}}</td>
                <td class="text-center">{{$fornecedor->nome}}</td>
                <td>

                    <div class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#alterarProduto{{$fornecedor->id}}" class="text-success" href="#">alterar</a>
                        <a data-bs-toggle="modal" data-bs-target="#deletarProduto{{$fornecedor->id}}" class="text-danger" href="#">deletar</a>
                    </div>


                     <!-- MODAL ALTERAR Produto -->
                     <div class="modal fade text-left" id="alterarProduto{{$fornecedor->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/fornecedores/alterar">
                                        @csrf
                                        
                                        <input type="hidden" name="id" value="{{$fornecedor->id}}">
                                        
                                        <div class="col-sm-12 mb-3 ">
                                            <label for="nome" class="text-left">Nome <span class="text-danger">*</span></label>
                                            <input id="nome" type="text" class="form-control" name="nome" value="{{$fornecedor->nome}}" autofocus required>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Alterar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- MODAL DELETAR Produto -->
                    <div class="modal fade" id="deletarProduto{{$fornecedor->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Confirme se deseja deletar o produto {{$fornecedor->id}}</p>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger" href="/fornecedores/deletar/{{$fornecedor->id}}">Deletar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container text-center">
    <button data-bs-toggle="modal" data-bs-target="#inserirFornecedor" type="button" class="btn btn-primary">Inserir Fornecedor</button>
</div>
<!--MODAL INSERIR Fornecedor-->
<div class="modal fade" id="inserirFornecedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="/fornecedores/inserir">
                @csrf
                
                <div class="col-sm-12 mb-3">
                    <label for="nome">Nome <span class="text-danger">*</span></label>
                    <input id="nome" type="text" class="form-control" name="nome" autofocus required>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success">Inserir</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection