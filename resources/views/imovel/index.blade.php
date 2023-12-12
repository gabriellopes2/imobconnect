@extends('adminlte::page')

@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">
                        <a href="{{ route('imovel.index') }}">
                        </a>
                    </h5>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb bg-transparent">
                        <li class="breadcrumb-item active" aria-current="page">Imóveis</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fa fa-list"></i>
        <h4>Aprovação de Imóveis</h4>
        <hr class="m-b-5">
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
                <form method="GET" action="{{ route('imovel.index') }}">
                    <div class="input-group mb-3">
                        <input class="form-control" name="search" value="{{ request('search') ?? '' }}"
                            placeholder="Pesquisar por vendedor..." />
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <hr>

            <div class="col-md-12 table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Ações</th>
                            <th>Id</th>
                            <th>Tipo de imóvel</th>
                            <th>Endereço</th>
                            <th>Locação</th>
                            <th>Venda</th>
                            <th>Valor do aluguel</th>
                            <th>Valor da venda</th>
                            <th>Vendedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($imoveis as $imovel)
                        <tr>
                            <td class="text-center">

                                <a class="btn btn-success" href="/imovel/{{$imovel->id}}/aprovar">
                                    <i class="fa fa-check"></i>
                                </a>

                                <form action="/imovel/{{$imovel->id}}/delete" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>

                            </td>
                            <td>{{ $imovel->id }}</td>
                            <td>{{ $imovel->tipo->descricao ?? '-' }}</td>
                            <td>{{ $imovel->idendereco }}</td>
                            <td>{{ icon_status($imovel->islocation) }}</td>
                            <td>{{ icon_status($imovel->isvenda) }}</td>
                            <td>R$ {{ $imovel->valoraluguel }}</td>
                            <td>@if (isset($imovel->valorvenda)) R$ {{ $imovel->valorvenda }} @else - @endif</td>
                            <td>{{$imovel->pessoa->nome}}</td>
                            
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
@endsection