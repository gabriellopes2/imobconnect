@extends('adminlte::page')

@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">
                        <a href="{{ route('tipoimovel.index') }}">
                        </a>
                    </h5>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb bg-transparent">
                        <li class="breadcrumb-item active" aria-current="page">Tipo de Imóveis</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
    @isset($mensagemSucesso)
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
    @endisset

<div class="card">
    <div class="card-header">
        <i class="fa fa-list"></i>
        <h4>Listagem de Tipos de Imóveis</h4>
        <hr class="m-b-5">
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
                <form method="GET" action="{{ route('tipoimovel.index') }}">
                    <div class="input-group mb-3">
                        <input class="form-control" name="search" value="{{ request('search') ?? '' }}"
                            placeholder="Pesquisar descrição..." />
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6 text-right">
                <a href="{{ route('tipoimovel.create') }}" class="btn btn-info">
                    <i class="fa fa-plus"></i> Novo tipo de imóvel
                </a>
            </div>

            <hr>

            <div class="col-md-12 table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Ações</th>
                            <th>Id</th>
                            <th>Descrição</th>
                            <th class="text-center">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tipoimoveis as $tipoimovel)
                        <tr>
                            <td class="text-center">

                                <a class="btn btn-success" href="{{ route('tipoimovel.edit', $tipoimovel->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('tipoimovel.destroy', $tipoimovel->id) }}" method="POST">


                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>

                            </td>
                            <td>{{ $tipoimovel->id }}</td>
                            <td>{{ $tipoimovel->descricao }}</td>
                            <td>{{ icon_status($tipoimovel->ativo) }}</td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-danger text-center">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    Oops... nenhum registro encontrado!
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection