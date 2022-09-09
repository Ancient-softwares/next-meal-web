@extends('layouts.sidebar')

@section('titulo', 'Index')
<header>
    <link href="{{ asset('css/editsRotasCrud/index.css') }}" rel="stylesheet" type="text/css">

</header>

@section('conteudo')


<div class="sla">
    <div class="teste">

        <reservas>
            <div class="style-reservas">
                <div class="conteudo">
                    <div class="numero">20</div>
                    <div class="icon">
                        <img src="{{ asset('img/sidebar/calendario-linhas-caneta.png') }}" alt="">
                    </div>
                </div>
                <h1 class="txtreserva">reservas</h1>
            </div>

        </reservas>
        <grafico>

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
                        <td><img src="{{ asset('img/tabelas/lixo.png') }}" alt=""></td>
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
                        <td><img src="{{ asset('img/tabelas/lixo.png') }}" alt=""></td>
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