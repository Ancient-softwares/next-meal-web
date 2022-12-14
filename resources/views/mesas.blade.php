@extends('layouts.hamburguer')

@section('titulo', 'Mesas')

@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/editsRotasCrud/styleTable.css') }}" rel="stylesheet" type="text/css">
<link href="/website/css/uicons-outline-rounded.css" rel="stylesheet">

@endsection

<!-- ICONE -->
<link rel="icon" href="{{ asset('img/iconNM.png')}}">

@section('conteudo')
<div class="container-cont2">

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Button trigger modal -->
    <div class="btn-cadastro">

        <h1>Mesas</h1>
        <a href="{{ route('mesas.create') }}" class="btn btn-light menu-prato">
            Cadastrar
        </a>
    </div>

    {{-- Tabela --}}
    <div class="scroll2"> 
        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Quantidade de acentos</th>
                <th scope="col">Numeração da Mesa</th>
                <th scope="col">Status da mesa</th>
                <th scope="col">Ações</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($mesas as $mesa)
            <tr>
                <th scope="row">{{ $mesa->idMesa }}</th>
                <td>{{ $mesa->quantAcentosMesa }}</td>
                <td>{{ $mesa->numMesa }}</td>
                <td>{{ $mesa->statusMesa == "0" ? "Fechada" : "Aberta" }}</td>
                <td>
                    <a  href="{{ url("mesas/$mesa->idMesa/edit") }}"><img class="botoes-editar" src="{{ asset('img/tabelas/editar.png') }}" alt=""></a>
                    <a value="{{ $mesa->idMesa }}" data-bs-toggle="modal" data-bs-target="#excluir{{ $mesa->idMesa }}"><img class="botoes-excluir" src="{{ asset('img/tabelas/excluir.png') }}" alt=""></a>
                </td>

                {{-- DELETAR MODEL --}}
                <form action="{{ route('mesas.destroy', $mesa->idMesa) }}" method="post">
                    {{ method_field('delete') }}
                    @csrf

                    <div class="modal fade" id="excluir{{ $mesa->idMesa }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Deletar a mesa de ID {{ $mesa->idMesa }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza que deseja deletar a mesa?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-light">Deletar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- EDITAR MODEL -->
                <form action="{{ route('mesas.update', $mesa->idMesa) }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="modal fade" id="editar{{ $mesa->idMesa }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar a mesa de ID {{ $mesa->idMesa }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label>Quantidade de acentos</label>
                                    <div class="inputbox">
                                        <input type="number" name="quantAcento" class="form-control" value="{{ $mesa->quantAcento }}">
                                    </div>

                                    <div class="inputbox">
                                        <label>Status da mesa:</label>
                                        <input class="form-check-input" name="status" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="0" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Fechada
                                        </label>
                                        <input class="form-check-input" name="status" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="1" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Aberta
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-primary">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection