@extends('admin.admin')

@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('conteudo')
<div class="container-cont">
<h1>Área do administrador</h1>
<br>
<div class="row">
    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Quantidade de clientes</h5>
              <p class="card-text">5 bilhões</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Quantidade de restaurante</h5>
              <p class="card-text">5 bilhões</p>
            </div>
        </div>
    </div>

</div>


</div>
@endsection