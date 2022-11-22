@extends('admin.admin')

@section('titulo', 'Tipos de restaurante')

@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/editsRotasCrud/styleTable.css') }}" rel="stylesheet" type="text/css">
<link href="/website/css/uicons-outline-rounded.css" rel="stylesheet">
@endsection


@section('conteudo')
<div class="container-cont">

    <h1>Tipos de restaurante cadastrados</h1>
    <br>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Tipo de restaurante</th>
                <th scope="col">Ações</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($tipos as $tipo)
            <tr>
                <th scope="row">{{ $tipo->tipoRestaurante }}</th>
                <td>
                    <a ><img class="botoes-editar" src="{{ asset('img/tabelas/editar.png') }}" alt=""></a>
                    <a value="{{ $tipo->idTipoRestaurante }}" data-bs-toggle="modal" data-bs-target="#excluir{{ $tipo->idTipoRestaurante }}"><img class="botoes-excluir" src="{{ asset('img/tabelas/excluir.png') }}" alt=""></a>
                </td>

            </tr>
            
            {{-- MODAL DE DELETE --}}
            <div class="modal fade" id="excluir{{ $tipo->idTipoRestaurante }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form method="POST" action="{{ route('tipo-restaurante.destroy', $tipo->idTipoRestaurante) }}">
                    @csrf
                    @method('delete')
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header modal-custom">
                            <h5 class="modal-title" id="exampleModalLabel">Deletar o tipo {{ $tipo->tipoRestaurante }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-custom">
                            Tem certeza que deseja deletar o tipo?
                        </div>
                        <div class="modal-footer modal-custom">
                            <button type="button" class="btn btn-secondary btn btn-custom-excluir" data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" class="btn btn-danger" value="Excluir">
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        

            @endforeach
        </tbody>
    </table>
</div>
@endsection