@extends('admin.admin')

@section('titulo', 'Admin')


@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/reserva.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
@endsection

@section('conteudo')
<div class="container-cont">
    <h1>Área do administrador</h1>
    <br>
    <div class="style-reservas">
        <div class="row rowDash">
            <div class="col colDash">
                <div class="card-dash">
                    <div class="card-body cardDash">
                        <h5 class="card-title">Quantidade de clientes</h5>
                        <p class="card-text">{{ $quantidadeCliente }}</p>
                    </div>
                </div>
            </div>
            <div class="col colDash">
                <div class="card-dash">
                    <div class="card-body cardDash">
                        <h5 class="card-title">Quantidade de restaurantes</h5>
                        <p class="card-text">{{ $quantidadeRestaurante }}</p>
                    </div>
                </div>
            </div>

                <div class="col colDash">
                    <canvas id="myChart" class="grafico"></canvas>
                    <script>
                        const ctx = document.getElementById('myChart').getContext('2d');

                        var valores = JSON.parse('{!! json_encode($graficoValorRestaurantes) !!}');
                        var meses = JSON.parse('{!! json_encode($graficoMes) !!}');

                        const myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: meses,
                                datasets: [{
                                    label: 'Restaurantes cadastrados por mês',
                                    data: valores,
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
            </div>
        </div>

    </div>


</div>

@endsection