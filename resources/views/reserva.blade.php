@extends('layouts.hamburguer')

@section('Reservas')

@endsection

@section('css')
<link href="{{ asset('css/reserva.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('conteudo')

<div class="container-cont">
    @if($errors->any())

    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
    </div>
    @endif

    <div class="reserva">
        <h1>Reservas</h1>
    </div>
    <div class="global">
        <h4>Pendentes</h4>
        <div class="aceitar-reserva scroll">
            @foreach($reservas as $r)
            <div class="card-group">
                <div class="card">
                    <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$r->idCliente}}</h5>
                        <p class="card-text">Data: {{$r->dataReserva}} {{$r->horaReserva}}</p>
                        <p class="card-text">Mesa: {{$r->numPessoas}} acentos.</p>
                    </div>
                    <div class="botoes">
                        <a href="{{ route('cardapio.create') }}" class="btn btn-light">
                            Aceitar
                        </a>
                        <a href="{{ route('cardapio.create') }}" class="btn btn-light">
                            Recusar
                        </a>
                    </div>
                </div>
            </div>
            @endForeach
        </div>

        
        <h4>Aceitas</h4>
        <div class="reservados scroll-lateral">
            <div class="row row-cols-1 row-cols-md-6 g-4">
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno Teixeira Pereira Pires </h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('img/sidebar/casa.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bruno</h5>
                            <p class="card-text">Data: 12/02/2022 12:30</p>
                            <p class="card-text">Mesa com: 12 acentos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection