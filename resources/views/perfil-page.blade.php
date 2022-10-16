@extends('layouts.hamburguer')

@section('titulo', 'Perfil')

@section('css')
<link href="{{ asset('css/editsRotasCrud/perfil.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('conteudo')

<div class="container-perfil">
    <h1 class="txt-Perfil">Perfil</h1>
    <hr>
    <div class="FundoFoto">

        <div class="fotoPerfil">
            <img class="foto-perfil" src="img/fotosPerfil/{{ $info->fotoRestaurante ?? 'user.png' }}">
        </div>

    </div>

    <h1>{{ $info->nomeRestaurante }}</h1>
    <h3>{{ $info->ruaRestaurante ?? 'Endereço' }}</h3>
    <h4>{{ $info->bairroRestaurante ?? 'Bairro' }}</h4>
    <div class="btn-cadastro">
        <a href="{{ route('editar-perfil') }}" class="btn btn-light menu-prato">
            Editar
        </a>
    </div>
</div>

@endsection