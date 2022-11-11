@extends('layouts.hamburguer')

@section('titulo', 'Pratos')

@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/editsRotasCrud/styleTable.css') }}" rel="stylesheet" type="text/css">
<link href="/website/css/uicons-outline-rounded.css" rel="stylesheet">
@endsection

<!-- ICONE -->
<link rel="icon" href="{{ asset('img/iconNM.png')}}">

@section('conteudo')


<div class="container-cont">
    @if($errors->any())


    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
    </div>
    @endif

    <div class="btn-cadastro">

        <h1>Pratos</h1>
        <a href="{{ route('cardapio.create') }}" class="btn btn-light">
            Cadastrar
        </a>
    </div>

    <!-- Button trigger modal -->



    <!--{{-- Tabela --}}
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome do prato</th>
            <th scope="col">Valor do prato</th>
            <th scope="col">Ingredientes do prato</th>
            <th scope="col">Foto do prato</th>
            <th scope="col">Tipo do prato</th>
            <th scope="col">Ações</th>

        </tr>
    </thead>
    <tbody>

         @foreach ($pratos as $prato)
        <tr>
            <th scope="row">{{ $prato->idPrato }}</th>
            <td>{{ $prato->nomePrato }}</td>
            <td>R$ {{ $prato->valorPrato }}</td>
            <td>{{ $prato->ingredientesPrato }}</td>
            <td><img src="/img/pratos/{{ $prato->fotoPrato }}" width="65%"></td>
            <td>{{ $tipos->where('idTipoPrato', $prato->idTipoPrato)->first()->tipoPrato }}</td>
            <td>
                <a href="{{ url("cardapio/$prato->idPrato/edit") }}"><img class="botoes-editar" src="{{ asset('img/tabelas/lapis.png') }}" alt=""></a>
                <a value="{{ $prato->idPrato }}" data-bs-toggle="modal" data-bs-target="#excluir{{ $prato->idPrato }}"><img class="botoes-excluir" src="{{ asset('img/tabelas/lixo.png') }}" alt=""></a>
            </td>

             DELETAR MODEL
            <form action="{{ route('cardapio.destroy', $prato->idPrato) }}" method="post">
                {{ method_field('delete') }}
                @csrf

                <div class="modal fade" id="excluir{{ $prato->idPrato }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deletar o Prato {{ $prato->nomePrato }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja deletar o Prato?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-danger">Deletar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </tr>
        @endforeach

    </tbody>
    </table> -->

    <!-- CARDSSS -->



    <div class="card-deck row row-cols-1 row-cols-md-6 g-4 scroll">

        @foreach ($pratos as $prato)

        <div class="col">
            <div class="card">
                <img class="card-img-top" src="/img/pratos/{{ $prato->fotoPrato }}" width="65%" height="50%">
                <div class="card-body">
                    <h5 class="card-title">{{ $prato->nomePrato }}</h5>
                </div>
                <p class="card-text">{{ $tipos->where('idTipoPrato', $prato->idTipoPrato)->first()->tipoPrato }}</p>
                <div class="card-footer">
                    <button type="button" data-bs-toggle="modal" href="#exampleModalToggle{{ $prato->idPrato }}" class="btn btn-light mais-informacoes">Detalhes</button>
                    <div class="editar-excluir">
                        <a href="{{ url("cardapio/$prato->idPrato/edit") }}"><img class="botoes-editar" src="{{ asset('img/tabelas/editar.png') }}" alt=""></a>
                        <a value="{{ $prato->idPrato }}" data-bs-toggle="modal" data-bs-target="#excluir{{ $prato->idPrato }}"><img class="botoes-excluir" src="{{ asset('img/tabelas/excluir.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
            <!-- DELETAR MODEL -->
            <form action="{{ route('cardapio.destroy', $prato->idPrato) }}" method="post">
                {{ method_field('delete') }}
                @csrf

                <div class="modal fade" id="excluir{{ $prato->idPrato }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deletar o Prato {{ $prato->nomePrato }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja deletar o Prato?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-outline-danger">Deletar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal fade" id="exampleModalToggle{{$prato->idPrato}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Detalhes</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ftprato">
                                <img class="card-img-top" src="/img/pratos/{{ $prato->fotoPrato }}">
                            </div>
                            <h3>{{ $prato->nomePrato }}</h3>

                            <h6><b>Tipo do prato:</b> {{ $tipos->where('idTipoPrato', $prato->idTipoPrato)->first()->tipoPrato }}</h6>
                            <h6><b>Ingredientes:</b> {{$prato->ingredientesPrato}}</h6>
                            
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach


    </div>
</div>
@endsection