@extends('layouts.hamburguer')

@section('titulo', 'Perfil')

@section('css')
<link href="{{ asset('css/editsRotasCrud/perfil.css') }}" rel="stylesheet" type="text/css">

@endsection

<!-- ICONE -->
<link rel="icon" href="{{ asset('img/iconNM.png')}}">

@section('conteudo')

<div class="container-perfil">
    <h1 class="txt-Perfil">Perfil</h1>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <div class="cardzinho">
                <div class="FundoFoto">
                    <div class="fotoPerfil">
                        <img class="foto-perfil" src="img/fotosPerfil/{{ $info->fotoRestaurante ?? 'user.png' }}">
                    </div>
                </div>
                <div class="info">
                    <h1>{{ $info->nomeRestaurante }}</h1>
                    <h3>{{ $info->ruaRestaurante ?? 'Endereço' }}</h3>
                    <h3>{{ $info->bairroRestaurante ?? 'Bairro' }}</h3>
                    <div class="btn-cadastro">
                        <a href="{{ route('editar-perfil') }}" class="btn btn-light menu-prato">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 scroll">
            <form action="{{ route('atualizar-descricao') }}" method="post">
                @csrf
                <button onclick="return showTipoNovo()"><img class="botoes-editar" src="{{ asset('img/tabelas/editar.png') }}" alt=""></button>
                <input type="submit" id="enviar" value="Enviar" hidden>
                <br>

                <label class="form-label">Descrição do restaurante</label>
                <textarea class="form-control form form-custom" name="descricao" id="descricao" style="resize: none;" name="descricao" cols="40" rows="9" readonly>{{ $info->descricaoRestaurante }}</textarea>
            </form>
        </div>
    </div>

    
    
</div>


<script>
    function showTipoNovo() {
        var enviar = document.getElementById('enviar');
        let hidden = enviar.getAttribute("hidden");

        var descricao = document.getElementById('descricao');

        console.log(enviar);
        console.log(hidden);

        if(hidden) {
            enviar.removeAttribute("hidden");
            descricao.removeAttribute("readonly");
        } 
        else {
            enviar.setAttribute("hidden", "hidden");
            descricao.setAttribute("readonly", "readonly");

        }

        return false;
    }
    
</script>

@endsection