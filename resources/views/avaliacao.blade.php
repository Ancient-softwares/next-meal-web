@extends('layouts.hamburguer')

@section('titulo', 'Mesas')
<header>
    <link href="{{ asset('css/editsRotasCrud/avaliacao.css') }}" rel="stylesheet" type="text/css">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</header>

@section('conteudo')

<div class="container-avaliacao">
    <h1>Avaliacões</h1>
    <!-- <div class="card-avalicao">
        <div class="conteudo-avaliacao">
            <div class="img-perfil">
                <img src="{{asset('img/restaurante.jpg')}}" alt="">
            </div>
            <div class="nome">
                <h3>Maria Clara Da Silva</h3>
                <hr>
                <div class="nota">
                    <img src="{{asset('img/estrela.png')}}" alt="">
                    <h3>4,0</h3>
                </div>
                <div class="desc">
                    <p>
                        Restaurante com ótimo atendimento, ADUREI. Restaurante com ótimo atendimento, ADUREI. Restaurante com ótimo atendimento, ADUREI. Restaurante com ótimo atendimento, ADUREI. Restaurante com ótimo atendimento, ADUREI.
                    </p>
                </div>
            </div>
        </div>
    </div> -->

    <div class="scrollagemTop scroll">
        <div class="row">
            @foreach($avaliacoes as $a)
            <div class="col-sm-6">
                <div class="card-avalicao">
                    <div class="conteudo-avaliacao">
                        <div class="img-perfil">
                            <img src="{{asset('img/restaurante.jpg')}}" class="img-Avaliação" alt="">
                        </div>
                        <div class="nome">
                            <h3>{{$a->nomeCliente}}</h3>
                            <hr class="hrChav">
                            <div class="nota">
                                <img src="{{asset('img/estrela.png')}}" alt="">
                                <h3>{{$a->notaAvaliacao}}</h3>
                            </div>
                            <div class="desc">
                                <p>{{$a->descAvaliacao}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>



    @endsection