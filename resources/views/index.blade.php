@extends('layouts.hamburguer')

@section('titulo', 'Index')

@section('css')
<link href="{{ asset('css/editsRotasCrud/index.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('css/grafico.css') }}">
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

<!-- ICONE -->
<link rel="icon" href="{{ asset('img/iconNM.png')}}">

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src = "https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
@endsection



@section('conteudo')


<div class="sla">
    <div class="teste">

        <reservas>
            <div class="style-reservas">
                <div class="conteudo">
                    <div class="numero">{{$reservas}}</div>
                    <div class="icon">
                        <img src="{{ asset('img/sidebar/calendario-linhas-caneta.png') }}" alt="">
                    </div>
                    <h1 class="txtreserva">Reservas concluídas</h1>
                </div>

            </div>

        </reservas>
        <grafico>
            <canvas id="myChart" class="grafico"></canvas>
            <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                
                var valores = JSON.parse('{!! json_encode($graficoValor) !!}');
                var meses = JSON.parse('{!! json_encode($graficoMes) !!}');
                
                const myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: meses,
                        datasets: [{
                            label: 'Reservas feitas em 6 meses',
                            data: valores,
                            borderWidth: 6,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                    }
                });
            </script>
        </grafico>
    </div>
    <div class="container-dash">
        <clientes-fieis>
            <table class="table table-hover tabela">
                <thead>
                    <tr>
                        <h3 class="clientes-h3">Clientes fiéis</h3>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fieis as $f)
                    <tr>
                        <td><img src="{{ asset('img/perfil.png') }}" alt=""></td>
                        <td colspan="2">{{$f->nomeCliente}}</td>
                        <td>Reservas: {{$f->totalReservas}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </clientes-fieis>
        <clientes-recentes>
            <table class="table table-hover tabela">
                <thead>
                    <tr>
                        <h3 class="clientes-h3">Clientes recentes</h3>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentes as $r)
                    <tr>
                        <td><img src="{{ asset('img/perfil.png') }}" alt=""></td>
                        <td>{{$r->nomeCliente}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </clientes-recentes>
    </div>
</div>
<!-- <div class="container-dash">
        <h1>Dashboard</h1>

        <div class="card-reservas">
            
        </div>
        <div class="clientes-fieis">
            <table border="1">
                <h1>Clientes fieis</h1>
                <tr>
                    <th><h4>foto Cliente</h4></th>
                    <th><h4>nome cliente</h4></th>
                    <th><h4>reservas</h4></th>
                </tr>
                <tr>
                    <td>salve</td>
                    <td>salve</td>
                </tr>
            </table>
        </div> -->
<!-- <div class="clientes-recentes">
            <table>
                <h1>Clientes recentes</h1>
                <tr>
                    <th><h4>foto cliente</h4></th>
                    <th><h4>nome</h4></th>
                </tr>
            </table>
        </div> -->
</div>
@endsection