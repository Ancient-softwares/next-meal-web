@extends('layouts.hamburguer')

@section('titulo', 'Index')
<header>
    <link href="{{ asset('css/editsRotasCrud/index.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/grafico.css') }}">
</header>

<script>
    < script src = "https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" />
</script>

</script>

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
                    <h1 class="txtreserva">Reservas</h1>
                </div>

            </div>

        </reservas>
        <grafico>
            <canvas id="myChart" class="grafico"></canvas>
            <script class="grafico">
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
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
                });
            </script>
        </grafico>
    </div>
    <div class="container-dash">
        <clientes-fieis>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <h3 class="clientes-h3">Clientes fiéis</h3>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="{{ asset('img/FotosDePratosPraApoio/burguer.png') }}" alt=""></td>
                        <td colspan="2">BRUNIN GAMEPRAY</td>
                        <td>RESERVAS 1345</td>
                    </tr>
                </tbody>
            </table>
        </clientes-fieis>
        <clientes-recentes>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <h3 class="clientes-h3">Clientes recentes</h3>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="{{ asset('img/FotosDePratosPraApoio/donuts.png') }}" alt=""></td>
                        <td>BRUNIN GAMEPRAY</td>
                    </tr>
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