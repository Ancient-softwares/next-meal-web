@extends('admin.admin')

@section('titulo', 'Clientes')

@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/reserva.css') }}" rel="stylesheet" type="text/css">
@endsection



@section('conteudo')
<div class="container-cont">

<h1>Restaurantes cadastrados</h1>

<div class="scroll2">
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">CEP</th>
            <th scope="col">Rua</th>
            <th scope="col">Bairro</th>
            <th scope="col">Cidade</th>
            <th scope="col">Data de cadastro</th>
        </tr>
    </thead>
        <tbody>
            @foreach ($restaurantes as $restaurante)
            <tr>
                <th>{{ $restaurante->idRestaurante }}</th>
                <td>{{ $restaurante->nomeRestaurante }}</td>
                <td>{{ $restaurante->telRestaurante }}</td>
                <td>{{ $restaurante->emailRestaurante}}</td>
                <td>{{ $restaurante->cepRestaurante}}</td>
                <td>{{ $restaurante->ruaRestaurante}}</td>
                <td>{{ $restaurante->bairroRestaurante}}</td>
                <td>{{ $restaurante->cidadeRestaurante}}</td>
                <td>{{ $restaurante->created_at }}</td>
            </tr>
            @endforeach
        </tbody>    
</table>

</div>
{{ $restaurantes->links() }}
@endsection