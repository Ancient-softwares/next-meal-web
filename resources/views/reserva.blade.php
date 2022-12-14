@extends('layouts.hamburguer')

@section('Reservas')

@endsection

@section('css')
<link href="{{ asset('css/reserva.css') }}" rel="stylesheet" type="text/css">
@endsection

<!-- ICONE -->
<link rel="icon" href="{{ asset('img/iconNM.png')}}">

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
        <div class="aceitar-reserva">
            

    <div class="title">
        <h2>Pendentes</h2>
    </div>
            <div class="scroll">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($reservas as $r)
                    @if($r->idStatusReserva == 3)
                    <div class="card-group">
                        <div class="card" style="padding: 0; margin-right: 0.2em; margin-left: 0.2em;">
                            <img src="{{ asset('img/perfil.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $clientes->where('idCliente',
                                    $r->idCliente)->first()->nomeCliente }}</h5>
                                <p class="card-text">Data: {{$r->dataReserva}} {{$r->horaReserva}}</p>
                                <p class="card-text">Mesa: {{$r->numPessoas}} acentos.</p>
                                <p class="card-text">Status: {{ $status->where('idStatusReserva',
                                    $r->idStatusReserva)->first()->statusReserva }}.</p>

                            </div>
                            <div class="botoes">
                                <a href="{{ route('aceitar-reserva', ['id'=>$r->idReserva]) }}" class="btn btn-light">
                                    Aceitar
                                </a>
                                <a href="{{ route('rejeitar-reserva', ['id'=>$r->idReserva]) }}" class="btn btn-light">
                                    Recusar
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endForeach
                </div>
            </div>
        </div>
                                    
        <div class="flex">
            <div class="title-aceitas">
                <h2>Aceitas</h2>
            </div>
            <div class="reservados scroll">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($reservas as $r)
                    @if($r->idStatusReserva == 1 )

                    <div class="col" style="padding: 0; ">
                        <div class="card" style="padding: 0; margin-right: 0.2em; margin-left: 0.2em;">
                            <img src="{{ asset('img/perfil.png') }}" class="card-img-top" alt="...">
                            <div class="card-body" style="padding-top: 6px;">
                                <h5 class="card-title">{{ $clientes->where('idCliente',
                                    $r->idCliente)->first()->nomeCliente }}</h5>
                                <p class="card-text">Data: {{$r->dataReserva}} {{$r->horaReserva}}</p>
                                <p class="card-text">Mesa: {{$r->numPessoas}} acentos</p>
                            </div>
                            <div class="botoes">
                                <a href="{{ route('finalizar-reserva', ['id'=>$r->idReserva]) }}" class="btn btn-light">
                                    Finalizar
                                </a>
                            </div>

                        </div>
                    </div>
                    @endif
                    @endForeach
                </div>
            </div>
            <div class="title-finalizadas">
                <h2>Finalizadas</h2>
            </div>
            <div class="reservados">

                <div class="scroll">

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($reservas as $r)
                        @if($r->idStatusReserva == 4)

                        <div class="col" style="padding-right: 0.2em; padding-left: 0.2em;">
                            <div class="card">
                                <img src="{{ asset('img/perfil.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $clientes->where('idCliente',
                                        $r->idCliente)->first()->nomeCliente }}</h5>
                                    <p class="card-text">Data: {{$r->dataReserva}} {{$r->horaReserva}}</p>
                                    <p class="card-text">Mesa: {{$r->numPessoas}} acentos</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endForeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection