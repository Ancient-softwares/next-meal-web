@extends('layouts.sidebar')

@section('titulo', 'Mesas')

@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/editsRotasCrud/styleTable.css') }}" rel="stylesheet" type="text/css">
<link href="/website/css/uicons-outline-rounded.css" rel="stylesheet">

@endsection

@section('conteudo')
<div class="container-cont">

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Button trigger modal -->
    <a href="{{ route('mesas.create') }}" class="btn btn-success menu-prato">
        Cadastrar mesa
    </a>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Mesa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mesas.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf

                        <label>Quantidade de acentos</label>
                        <div class="inputbox">
                            <input type="number" name="quantAcento" class="form-control">
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

                        <div class="inputbox">
                            <label>Numeração da mesa</label>
                            <input type="text" name="numMesa" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-outline-success">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{-- Tabela --}}
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Quantidade de acentos</th>
            <th scope="col">Status da mesa</th>
            <th scope="col">Numeração da Mesa</th>
            <th scope="col">Ações</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($mesas as $mesa)
        <tr>
            <th scope="row">{{ $mesa->idMesa }}</th>
            <td>{{ $mesa->quantAcentosMesa }}</td>
            <td>{{ $mesa->statusMesa == "0" ? "Fechada" : "Aberta" }}</td>
            <td>{{ $mesa->numMesa }}</td>
            <td>
                <a  href="{{ url("mesas/$mesa->idMesa/edit") }}"><img class="botoes-editar" src="{{ asset('img/tabelas/lapis.png') }}" alt=""></a>
                <a value="{{ $mesa->idMesa }}" data-bs-toggle="modal" data-bs-target="#excluir{{ $mesa->idMesa }}"><img class="botoes-excluir" src="{{ asset('img/tabelas/lixo.png') }}" alt=""></a>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-danger">Deletar</button>
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
@endsection