@extends('layouts.sidebar')

@section('titulo', 'Criar uma mesa')

@section('css')
    <link href="{{ asset('css/editsRotasCrud/crud.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('conteudo')
    <div class="container-cadastro">
        <div class="container-form scroll">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
            @endif

            <h1 class="text">@if(isset($mesa))Editar mesa de númeração {{ $mesa->numMesa }} @else Cadastrar mesa @endif </h1>
            <hr>

            @if(isset($mesa))
                <form method="post" action="{{ route('mesas.update', $mesa->idMesa) }}" enctype="multipart/form-data">
                @method('PUT')
            @else
                <form method="post" action="{{ route('mesas.store') }}" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="form-group">
                    <label for="quantAcentosMesa">Quantidade de acentos: </label>
                    <input type="number" class="form-control" name="quantAcentosMesa" id="quantAcentosMesa" value="{{$mesa->quantAcentosMesa ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="statusMesa">Status da Mesa:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="statusMesa" id="statusMesa" value="1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                          Aberta
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="statusMesa" id="statusMesa" value="0">
                        <label class="form-check-label" for="flexRadioDefault2">
                          Fechada
                        </label>
                      </div>
                </div>
                @if(!isset($mesa))
                <div class="form-group">
                    <label for="ingredientes">Númeração da mesa: </label>
                    <input type="number" class="form-control" name="numMesa" id="numMesa" value="{{$mesa->numMesa ?? ''}}">
                </div>
                @endif
                <button type="submit" class="btn btn-outline-light">@if(isset($mesa))Editar @else Cadastrar @endif</button>
            </form>
        </div>
    </div>
@endsection