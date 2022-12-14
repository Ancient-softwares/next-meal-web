@extends('admin.admin')

@section('titulo', 'Tipos de restaurante')

@section('css')
<link href="{{ asset('css/editsRotasCrud/cardapio.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/editsRotasCrud/styleTable.css') }}" rel="stylesheet" type="text/css">
<link href="/website/css/uicons-outline-rounded.css" rel="stylesheet">
@endsection


@section('conteudo')
<div class="container-cont">
    @if($errors->any())

    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
    </div>
    @endif
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
                <th scope="row"  class="th">{{ $tipo->tipoRestaurante }}</th>
                <td>
                    <a value="{{ $tipo->idTipoRestaurante }}" data-bs-toggle="modal" data-bs-target="#editar{{ $tipo->idTipoRestaurante }}"><img class="botoes-editar" src="{{ asset('img/tabelas/editar.png') }}" alt=""></a>
                    <a value="{{ $tipo->idTipoRestaurante }}" data-bs-toggle="modal" data-bs-target="#excluir{{ $tipo->idTipoRestaurante }}"><img class="botoes-excluir" src="{{ asset('img/tabelas/excluir.png') }}" alt=""></a>
                </td>

            </tr>

            {{-- MODAL DE EDITAR --}}
            <div class="modal fade" id="editar{{ $tipo->idTipoRestaurante }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form method="POST" action="{{ route('tipo-restaurante.update', $tipo->idTipoRestaurante) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header modal-custom">
                            <h5 class="modal-title" id="exampleModalLabel">Editar o tipo {{ $tipo->tipoRestaurante }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-custom">
                            <label>Nome do tipo de restaurante: </label>
                            <input class="form-control" name="tipo" type="text" value="{{ $tipo->tipoRestaurante }}" aria-label="default input example">
                        </div>
                        <div class="modal-footer modal-custom">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" class="btn btn-light" value="Editar">
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            
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
                            <button type="button" class="btn btn-light edit-excluir-tipo" data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" class="btn btn-light edit-excluir-tipo" value="Excluir">
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </tbody>
    </table>
            {{ $tipos->links() }}
</div>
@endsection