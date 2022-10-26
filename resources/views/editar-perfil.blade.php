@extends('layouts.hamburguer')

@section('titulo', 'editar-perfil')

@section('css')
<link href="{{ asset('css/editsRotasCrud/crud.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{ asset('js/validarCep.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script>
    $(document).ready(function($) {
        $("#telefone").mask("(00) 0000-0000");
        $("#cep").mask("00000-000");
        $("#cpf").mask("000.000.000-00");
    });
</script>
@endsection

@section('conteudo')


<div class="container-cadastro scroll">
    <div class="container-form">
        <h1 class="TitleRegisterMesa">Editar perfil</h1>
        <hr>
        <form action="{{ route('editou') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <label>Nome: </label>
                    <input type="text" class="form-control" name="nomeRestaurante" required value="{{ $info->nomeRestaurante ?? '' }}">
                </div>
                <div class="col-sm-6">
                    <label>Telefone: </label>
                    <input type="text" class="form-control" name="telRestaurante" id="telefone" required value="{{ $info->telRestaurante ?? '' }}">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-sm-6">
                    <label>Cnpj: </label>
                    <input type="text" class="form-control" name="cnpjRestaurante" required value="{{ $info->cnpjRestaurante ?? '' }}">
                </div>
                <div class="col-sm-6">
                    <label>E-mail: </label>
                    <input type="email" class="form-control" name="emailRestaurante" required value="{{ $info->emailRestaurante ?? '' }}">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-sm-6">
                    <label>Cep: </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="cepRestaurante" id="cep" required value="{{ $info->cepRestaurante ?? '' }}">
                        <button type="button" class="btn btn-light" id="validar">Validar</button>
                    </div>
                </div>
                <br>
                <div class="col-sm-6">
                    <label>Rua: </label>
                    <input type="text" class="form-control" name="ruaRestaurante" id="rua" required value="{{ $info->ruaRestaurante ?? '' }}">
                </div>
                <br>
            </div>


            <div class="row">
                <div class="col-sm-4">
                    <label>Número: </label>
                    <input type="text" class="form-control" name="numRestaurante" id="numero" required value="{{ $info->numRestaurante ?? '' }}">
                    <br>
                </div>
                <div class="col-sm-2">
                    <label>Estado: </label>
                    <input type="text" class="form-control" name="estadoRestaurante" id="estado" required value="{{ $info->estadoRestaurante ?? '' }}">
                </div>
                <div class="col-sm-6">
                    <label>Bairro: </label>
                    <input type="text" class="form-control" name="bairroRestaurante" id="bairro" required value="{{ $info->bairroRestaurante ?? '' }}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>Cidade: </label>
                    <input type="text" class="form-control" name="cidadeRestaurante" id="cidade" required value="{{ $info->cidadeRestaurante ?? '' }}">
                </div>
                <div class="col-sm-6">
                    <label>Tipo do restaurante: </label>
                    <select name="tipoRestaurante" class="form-control">
                        @foreach($tipos as $tipo)
                        <option value="{{ $tipo->idTipoRestaurante }}">{{ $tipo->tipoRestaurante }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>


            <div class="row">
                <div class="col-sm-6">
                    <label>Capacidade máxima: </label>
                    <input type="number" class="form-control" name="capMaximaRestaurante" value="{{ $info->capMaximaRestaurante ?? '' }}">
                </div>
                <div class="col-sm-6">
                    <label for="formFile" class="form-label">Foto</label>
                    <input type="file" name="fotoRestaurante" class="form-control form-imagem" id="formFile">
                </div>
            </div>


            <input type="submit" class="btn btn-light btn-editar" value="Editar">
            <br>
        </form>
    </div>
</div>




@endsection