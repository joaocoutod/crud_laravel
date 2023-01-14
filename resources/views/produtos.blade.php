@extends('layouts.main')

@section('title', 'Produtos')

@section('content')
<div class="container text-center p-3">
    <h1 class="text-muted display-5">Lista de Produtos</h1>
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


<div class="container table-responsive-md" >
    <table class="table">
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Valor</th>
                <th scope="col">fornecedor</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
    
        <tbody >
        @foreach ($produtos as $produto)
            <tr>
                <td class="text-center">{{$produto->id}}</td>
                <td class="text-center">{{$produto->nome}}</td>
                <td class="text-center">{{number_format($produto->valor, 2, ",", ".") }}</td>
                <td class="text-center">{{$produto->fornecedor_id}}</td>
                <td>
                    <div class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#alterarProduto{{$produto->id}}" class="text-success" href="#">alterar</a>
                        <a data-bs-toggle="modal" data-bs-target="#deletarProduto{{$produto->id}}" class="text-danger" href="#">deletar</a>
                    </div>


                     <!-- MODAL ALTERAR Produto -->
                     <div class="modal fade text-left" id="alterarProduto{{$produto->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/produtos/alterar">
                                        @csrf
                                        
                                        <input type="hidden" name="id" value="{{$produto->id}}">
                                        
                                        <div class="col-sm-12 mb-3 ">
                                            <label for="nome" class="text-left">Nome <span class="text-danger">*</span></label>
                                            <input id="nome" type="text" class="form-control" name="nome" value="{{$produto->nome}}" autofocus required>
                                        </div>
                                        <div class="col-sm-12 mb-3 text-left">
                                            <label for="valor">Valor <span class="text-danger">*</span></label>
                                            <input id="valor" type="number" class="form-control" name="valor" value="{{$produto->valor}}" autofocus required>
                                        </div>
                                        <div class="col-sm-12 mb-3 text-left">
                                            <label for="fornecedor">Selecione um fornecedor <span class="text-danger">*</span></label>
                                            <select name="fornecedor" id="fornecedor" class="form-control" autofocus required>
                                                @foreach ($fornecedores as $fornecedor)
                                                    @if ($fornecedor->id == $produto->fornecedor_id)
                                                        <option value="{{$fornecedor->id}}" selected>{{$fornecedor->nome}}</option>
                                                    @else
                                                        <option value="{{$fornecedor->id}}" >{{$fornecedor->nome}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
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
                    <div class="modal fade" id="deletarProduto{{$produto->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Confirme se deseja deletar o produto {{$produto->id}}</p>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger" href="/produtos/deletar/{{$produto->id}}">Deletar</a>
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
    <button data-bs-toggle="modal" data-bs-target="#inserirProduto" type="button" class="btn btn-primary">Inserir Produto</button>
</div>


<!--MODAL inserirProduto-->
<div class="modal fade" id="inserirProduto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="/produtos/inserir">
                @csrf
                
                <div class="col-sm-12 mb-3">
                    <label for="nome">Nome <span class="text-danger">*</span></label>
                    <input id="nome" type="text" class="form-control" name="nome" autofocus required>
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="valor">Valor <span class="text-danger">*</span></label>
                    <input id="valor" type="number" class="form-control" name="valor" autofocus required>
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="fornecedor">Selecione um fornecedor <span class="text-danger">*</span></label>
                    <select name="fornecedor" id="fornecedor" class="form-control" autofocus required>
                        @foreach ($fornecedores as $fornecedor)
                            <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                        @endforeach
                    </select>
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