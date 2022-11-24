@extends('admin.admin')

@section('titulo', 'Clientes')


@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/reserva.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('conteudo')

<div class="container-cont">

<h1>Clientes cadastrados</h1>
<br>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <th scope="row">{{ $cliente->idCliente }}</th>
            <td>{{ $cliente->nomeCliente }}</td>
            <td>{{ $cliente->telefoneCliente }}</td>
            <td>{{ $cliente->emailCliente }}</td>
            <td>{{ $cliente->cepRestaurante}}</td>
            <td>{{ $cliente->ruaRestaurante}}</td>
            <td>{{ $cliente->bairroRestaurante}}</td>
            <td>{{ $cliente->cidadeRestaurante}}</td>
        </tr>
        @endforeach
        {{ $clientes->links() }}
    </tbody>
    </table>
</div>
@endsection