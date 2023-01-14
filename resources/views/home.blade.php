@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="container text-center p-3">
  <h1 class="text-muted display-5">Relatório</h1>
</div>
<div class="container able-responsive">
    <table class="table text-center">
        <thead class="table-dark">
          <tr>
            <th scope="col">Nome do fornecedor</th>
            <th scope="col">Nome do Produto</th>
            <th scope="col">Valor do Produto</th>
          </tr>
        </thead>
        
        <tbody>
        @foreach ($relatorio as $item)
            <tr>
                <td>{{$item->fornecedor}}</td>
                <td>{{ $item->produto }}</td>
                <td>R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


@endsection