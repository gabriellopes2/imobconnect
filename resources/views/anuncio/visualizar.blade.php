<x-imovel.nav>
    <main class="page landing-page">
        <section style="margin-right: 40px;margin-left: 40px;margin-top: 30px;">
            <div class="container" style="margin-top: 20px;">
                <div class="row">
                    <div class="col-md-8">
                        <div class="simple-slider">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @forelse ($imovel->imagens as $imagem)
                                    <div class="swiper-slide" style="background: url(&quot;/storage/images/{{$imagem->imagem}}&quot;) center center / cover no-repeat;">
                                    <div class="slide-text" style="position: absolute; top: 0px; left: 0; width: 100%; color: #fff; text-align: center; z-index: 100; background-color: rgba(0, 0, 0, 0.5); padding: 5px 0;">
                                        {{$imagem->localimagem->descricao}}
                                    </div>
                                    </div>
                                    @empty
                                    <div class="swiper-slide" style="background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;"></div>                 
                                    @endforelse
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-4" style="display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <h1><td>{{ $imovel->titulo ?? '-' }}</td></h1>
                            <h3><td>{{ $imovel->tipo->descricao ?? '-' }}</td></h3>
                            <p>{{$imovel->endereco->rua}}, {{$imovel->endereco->numero}}, {{$imovel->endereco->bairro}}, {{$imovel->endereco->cidade->descricao}}</p>
                            <p>{{$imovel->detalheImovel->descricao}}</p>

                        </div>
                        <div>
                            @if ($imovel->islocation == true)
                            <div style="display: flex;">
                            <div style="width: 50%;"><h5 style="text-align: left;">Aluguel</h5></div>
                                <div style="width: 50%;"><h4 style="text-align: right;">R$ {{ number_format($imovel->valoraluguel, 2, ',', '.') }}</h4></div>
                            </div>
                            @endif
                            @if ($imovel->isvenda == true)
                            <div style="display: flex;">
                                <div style="width: 50%;"><h5 style="text-align: left;">Preço</h5></div>
                                <div style="width: 50%;"><h4 style="text-align: right;">R$ {{ number_format($imovel->valorvenda, 2, ',', '.') }}</h4></div>
                            </div>
                            @endif
                            <button class="btn btn-primary w-100" type="button">Entrar em Contato</button>
                        </div>
                    </div>
                    <div style="padding: 12px;">
                        <h1>Informações do Imóvel</h1>  
                        <div>                          
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Quantidade de Quartos</span></div>
                                <div style="width: 50%;"><span>{{$imovel->detalheImovel->numeroquartos}}</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Quantidade de Banheiros</span></div>
                                <div style="width: 50%;"><span>{{$imovel->detalheImovel->numerobanheiros}}</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Vagas de Estacionamento</span></div>
                                <div style="width: 50%;"><span>{{$imovel->detalheImovel->numerodevagas}}</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Tamanho</span></div>
                                <div style="width: 50%;"><span>{{$imovel->detalheImovel->metrosquadrados}}m²</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Mobilia</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->ismobiliado)
                                    Mobiliado
                                    @elseif ($imovel->detalheImovel->issemimobiliado)
                                    Semi Mobiliado
                                    @else
                                    Não Mobiliado
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Elevador</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->haselevador)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Internet</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->hasinternet)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Salão de Festas</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->hassalaodefestas)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Sacada</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->hassacada)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Lavanderia</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->haslavanderia)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Ar Condicionado</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->hasarcondicionado)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Area de Lazer</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->hasareadelazer)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Estacionamento</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->hasestacionamento)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Quantidade de Vagas</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->numerodevagas)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Animais Permitidos</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->isanimaispermitidos)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Portaria</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->hasportaria)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Churrasqueira</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->haschurrasqueira)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Piscina</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->haspiscina)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Quiosque</span></div>
                                <div style="width: 50%;"><span>@if ($imovel->detalheImovel->hasquiosque)
                                    Sim
                                    @else
                                    Não
                                    @endif</span></div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 50%;"><span>Cercado</span></div>
                                <div style="width: 50%;"><span>{{$imovel->detalheImovel->iscercado}}</span></div>
                            </div>   
                        </div>                         
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-imovel.footer/>
</x-imovel.nav>