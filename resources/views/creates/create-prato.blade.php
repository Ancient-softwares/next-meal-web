@extends('layouts.hamburguer')

@section('titulo', 'Criar um prato')

@section('css')
    <link href="{{ asset('css/editsRotasCrud/crud.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('conteudo')
    <div class="container-cadastro">
        <div class="container-form">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
            @endif

            <h1 class="text">@if(isset($prato))Editar @else Cadastrar @endif prato</h1>
            <hr>

            @if(isset($prato))
                <form method="post" action="{{ route('cardapio.update', $prato->idPrato) }}" enctype="multipart/form-data">
                @method('PUT')
            @else
                <form method="post" action="{{ route('cardapio.store') }}" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nomePrato" id="nome" placeholder="Digite o nome do prato" value="{{$prato->nomePrato ?? ''}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="number" class="form-control" name="valorPrato" id="valor" placeholder="Digite o valor do prato" value="{{$prato->valorPrato ?? ''}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Tipo do Prato</label>
                            <select class="custom-select" name="tipoPrato" aria-label="Default select example">
                                @if(isset($prato))
                                    <option selected value="{{ $prato->idTipoPrato ?? '' }}">{{ $tipos->where('idTipoPrato', $prato->idTipoPrato)->first()->tipoPrato }}</option>
                                @else
                                    <option selected disabled>Selecione um tipo</option>
                                @endif
        
                                @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->idTipoPrato }}">{{ $tipo->tipoPrato }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="ingredientes">Ingredientes</label>
                            <input type="text" class="form-control" name="ingredientePrato" id="ingredientes" placeholder="Digite os ingredientes" value="{{$prato->ingredientesPrato ?? ''}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Foto do Prato</label>
                            <input type="file" name="fotoPrato" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-light">@if(isset($prato))Editar @else Cadastrar @endif</button>
            </form>
        </div>
    </div>
@endsection