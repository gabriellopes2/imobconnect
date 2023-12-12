@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="botoes">
                        <div class="botao" id="btn1">
                            <div class="botao-titulo">Clientes</div>
                            <div class="botao-numero">{{$clientes->count()}}</div>
                        </div>
                        <div class="botao" id="btn2">
                            <div class="botao-titulo">Imóveis Anunciados</div>
                            <div class="botao-numero">{{$imoveisDisponiveis->count()}}</div>
                        </div>
                        <div class="botao" id="btn3">
                            <div class="botao-titulo">Imóveis Vendidos</div>
                            <div class="botao-numero">{{$imoveisVendidos->count()}}</div>
                        </div>
                        <div class="botao" id="btn4">
                            <div class="botao-titulo">Imóveis Alugados</div>
                            <div class="botao-numero">{{$imoveisAlugados->count()}}</div>
                        </div>
                    </div>
                    
                    <div class="grid">
                        <div class="grid-content" id="grid-clientes">
                            <div class="grid-row grid-header">
                                <div class="grid-cell">Nome</div>
                                <div class="grid-cell">Email</div>
                                <div class="grid-cell">Telefone</div>
                                <div class="grid-cell">Data de Registro</div>
                            </div>
                            <!-- Linhas de exemplo, adicione mais conforme necessário -->
                           @foreach ($clientes as $cliente)
                           <div class="grid-row">
                                <div class="grid-cell">{{$cliente->nome}}</div>
                                <div class="grid-cell">{{$cliente->usuario->email}}</div>
                                <div class="grid-cell">{{$cliente->telefone}}</div>
                                <div class="grid-cell">{{ $cliente->created_at->format('d/m/Y') }}</div>
                            </div> 
                           @endforeach
                        </div>
                        <div class="grid-content" id="grid-imoveisAnunciados">
                            <div class="grid-row2 grid-header">
                                <div class="grid-cell">Vendedor</div>
                                <div class="grid-cell">Tipo</div>
                                <div class="grid-cell">Aluguel</div>
                                <div class="grid-cell">Compra</div>
                            </div>
                            <!-- Linhas de exemplo, adicione mais conforme necessário -->
                           @foreach ($imoveisDisponiveis as $imovel)
                           <div class="grid-row2">
                                <div class="grid-cell">{{$imovel->pessoa->nome}}</div>
                                <div class="grid-cell">teste</div>
                                <div class="grid-cell">{{ icon_status($imovel->isvenda) }}</div>
                                <div class="grid-cell">{{ icon_status($imovel->islocation) }}</div>
                            </div> 
                           @endforeach
                        </div>
                        <div class="grid-content" id="grid-imoveisVendidos">
                            <!-- Conteúdo da grid Imóveis Vendidos -->
                        </div>
                        <div class="grid-content" id="grid-imoveisAlugados">
                            <!-- Conteúdo da grid Imóveis Alugados -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="/css/dashboard.css">

<script>

    document.getElementById("btn1").addEventListener("click", function() {
        hideAllGrids();
        document.getElementById("grid-clientes").style.display = "block";
    });

    document.getElementById("btn2").addEventListener("click", function() {
        hideAllGrids();
        document.getElementById("grid-imoveisAnunciados").style.display = "block";
    });

    document.getElementById("btn3").addEventListener("click", function() {
        hideAllGrids();
        document.getElementById("grid-imoveisVendidos").style.display = "block";
    });

    document.getElementById("btn4").addEventListener("click", function() {
        hideAllGrids();
        document.getElementById("grid-imoveisAlugados").style.display = "block";
    });

    function hideAllGrids() {
        var grids = document.getElementsByClassName("grid-content");
        for (var i = 0; i < grids.length; i++) {
            grids[i].style.display = "none";
        }
    }

</script>
@endsection
