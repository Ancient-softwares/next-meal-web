@extends('layouts.sidebar')

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


<div class="container-cadastro">
    <div class="container-form">
        <h1 class="TitleRegisterMesa">Editar perfil</h1>
        <hr>
        <form action="{{ route('editou') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Nome do restaurante: </label>
            <input type="text" class="form-control" name="nomeRestaurante" required value="{{ $info->nomeRestaurante ?? '' }}">
            <br>

            <label>Cpf do restaurante: </label>
            <input type="text" class="form-control" name="cpfRestaurante" id="cpf" required value="{{ $info->cpfRestaurante ?? '' }}">
            <br>

            <label>Telefone do restaurante: </label>
            <input type="text" class="form-control" name="telRestaurante" id="telefone" required value="{{ $info->telRestaurante ?? '' }}">
            <br>

            <label>E-mail do restaurante: </label>
            <input type="email" class="form-control" name="emailRestaurante" required value="{{ $info->emailRestaurante ?? '' }}">
            <br>

            <label>Cep do restaurante: </label>
            <div class="input-group">
                <input type="text" class="form-control" name="cepRestaurante" id="cep" required value="{{ $info->cepRestaurante ?? '' }}">
                <button type="button" class="btn btn-primary" id="validar">Validar</button>
            </div>
            <br>

            <label>Rua do restaurante: </label>
            <input type="text" class="form-control" name="ruaRestaurante" id="rua" required value="{{ $info->ruaRestaurante ?? '' }}">
            <br>
            
            <label>Número do restaurante: </label>
            <input type="text" class="form-control" name="numRestaurante" id="numero" required value="{{ $info->numRestaurante ?? '' }}">
            <br>
            
            <label>Bairro do restaurante: </label>
            <input type="text" class="form-control" name="bairroRestaurante" id="bairro" required value="{{ $info->bairroRestaurante ?? '' }}">
            <br>
            
            <label>Cidade do restaurante: </label>
            <input type="text" class="form-control" name="cidadeRestaurante" id="cidade" required value="{{ $info->cidadeRestaurante ?? '' }}">
            <br>
            
            <label>Estado do restaurante: </label>
            <input type="text" class="form-control" name="estadoRestaurante" id="estado" required value="{{ $info->estadoRestaurante ?? '' }}">
            <br>

            <label>capacidade máxima do restaurante: </label>
            <input type="number" class="form-control" name="capMaximaRestaurante" value="{{ $info->capMaximaRestaurante ?? '' }}">
            <br>

            <label>Tipo do restaurante: </label>
            <select name="tipoRestaurante" class="form-control">
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->idTipoRestaurante }}">{{ $tipo->tipoRestaurante }}</option>
                @endforeach
            </select>
            <br>

            <label>Foto do restaurante</label>
            <input type="file" name="fotoRestaurante" class="form-control">
            <br>

            <input type="submit" class="btn btn-success" value="Editar">
            <br>
        </form>
    </div>
</div>




@endsection