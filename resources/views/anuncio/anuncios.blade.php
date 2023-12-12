<x-imovel.nav>
    <main class="page landing-page">
    <form id="filtroForm" action="{{ route('anuncio.anuncios') }}" method="GET">
        <div class="filter-container" style="margin-right: 40px;margin-left: 40px;">
            
              <div class="filter-item">
				<label for="tipoanuncio">Tipo de Anúncio</label>
				<select class="form-select" id="tipoanuncio" name="tipoanuncio">
                    <option value="">Ambos</option> 
                    <option value="Venda" {{ (isset($filtro['tipoanuncio']) && $filtro['tipoanuncio'] == "Venda") ? 'selected' : '' }}>Venda</option> 
                    <option value="Aluguel" {{ (isset($filtro['tipoanuncio']) && $filtro['tipoanuncio'] == "Aluguel") ? 'selected' : '' }}>Aluguel</option>                    
				</select>
			  </div>
			  <div class="filter-item">
				<label for="idtipoimovel">Tipo do imóvel</label>
				<select class="form-select" id="idtipoimovel" name="idtipoimovel">
                    <option value="">Selecionar</option> 
                   @foreach ($allTipoImoveis as $tipoImovel)
                    <option value="{{$tipoImovel->id}}" {{ (isset($filtro['idtipoimovel']) && $filtro['idtipoimovel'] == $tipoImovel->id) ? 'selected' : '' }}>
                        {{$tipoImovel->descricao}}
                    </option>                      
                   @endforeach
				</select>
			  </div>
			  <div class="filter-item">
				<label for="cidade">Cidade</label>                
				<select class="form-select" id="cidade" name="idcidade">
                    <option value="">Selecionar</option> 
                    @foreach ($cidades as $cidade)
                        <option value="{{$cidade->id}}" {{ (isset($filtro['idcidade']) && $filtro['idcidade'] == $cidade->id) ? 'selected' : '' }}>
                            {{$cidade->descricao}}
                        </option>                       
                    @endforeach				  
				</select>
			  </div>
			  <div class="filter-item">
				<label for="bairro">Bairro</label>
				<input class="form-control" type="text" id="bairro" name="bairro" value="{{ isset($filtro['bairro']) ? $filtro['bairro'] : '' }}">
			  </div>
			  <div class="filter-item">
				<label for="numeroquartos">Quartos</label>
				<select class="form-select" id="numeroquartos" name="numeroquartos" value="{{ isset($filtro['numeroquartos']) ? $filtro['numeroquartos'] : '' }}">
                    <option value="">Selecionar</option> 
                    @for($i = 1; $i <= $numeroMaxQuartos; $i++)

                    <option value="{{$i}}" {{ (isset($filtro['numeroquartos']) && $filtro['numeroquartos'] == $i) ? 'selected' : '' }}>
                        {{$i}}
                    </option>

                    @endfor
				</select>
			  </div>
			  <div class="filter-item">
				<label for="numerodevagas">Vagas</label>
				<select class="form-select" id="numerodevagas" name="numerodevagas">
                    <option value="">Selecionar</option> 
                    @for($i = 1; $i <= $numeroMaxVagas; $i++)
                    <option value="{{$i}}" {{ (isset($filtro['numerodevagas']) && $filtro['numerodevagas'] == $i) ? 'selected' : '' }}>{{$i}}</option>
                    @endfor
				</select>
			  </div>
              <div class="filter-item">
			  <label for="range">Valor de Venda</label>
			  <div class="range-slider">                
				<input type="range" name="valorminvenda" id="lower" class="lower venda" min="{{$minPrecoVenda}}" max="{{$maxPrecoVenda}}" value="{{ isset($filtro['valorminvenda']) ? $filtro['valorminvenda'] : $minPrecoVenda }}" step="5000" oninput="updateSlider(this)">
				<input type="range" name="valormaxvenda" id="upper" class="upper venda" min="{{$minPrecoVenda}}" max="{{$maxPrecoVenda}}" value="{{ isset($filtro['valormaxvenda']) ? $filtro['valormaxvenda'] : $maxPrecoVenda}}" step="5000" oninput="updateSlider(this)">
			  </div>
			  <div class="slider-labels" style="padding-top:10px">
				  <span id="lower-value-venda">R$40000</span><br><span id="upper-value-venda">R$200000</span>
				</div>            
			    </div>

            <div class="filter-item">
			  <label for="range">Valor de Aluguel</label>
			  <div class="range-slider">
				<input type="range" name="valorminaluguel" id="lower2" class="lower aluguel" min="{{$minPrecoAluguel}}" max="{{$maxPrecoAluguel}}" value="{{ isset($filtro['valorminaluguel']) ? $filtro['valorminaluguel'] : $minPrecoAluguel}}" step="100" oninput="updateSlider(this)">
				<input type="range" name="valormaxaluguel" id="upper2" class="upper aluguel" min="{{$minPrecoAluguel}}" max="{{$maxPrecoAluguel}}" value="{{ isset($filtro['valormaxaluguel']) ? $filtro['valormaxaluguel'] : $maxPrecoAluguel}}" step="100" oninput="updateSlider(this)">
			  </div>
			  <div class="slider-labels" style="padding-top:10px">
				  <span id="lower-value-aluguel">R${{$minPrecoAluguel}}</span><br><span id="upper-value-aluguel">R${{$maxPrecoAluguel}}</span>
				</div>
			</div>


            
			<button type="submit" class="filter-item filter-button">
                <span>Buscar</span>
            </button>
        
		</div>
        </form>
        <section style="padding: 0px;margin: 10px;margin-right: 40px;margin-left: 40px;">
            <!--<div data-reflow-type="product-search">
				<div class="reflow-product-search">
					<div class="ref-input-wrapper"><input class="ref-search" type="text" inputmode="search" placeholder="Search Products" /><span class="ref-cancel-search" style="display: none;"></span></div>
					<div class="ref-button" type="submit" style="display: none;">Search</div>
				</div>
			</div>-->
            <div data-reflow-type="product-list" data-reflow-layout="cards" data-reflow-order="date_desc" style="padding: 0px;margin: 0px;">
				<div class="reflow-product-list ref-cards">
					<div class="ref-products">
                    @forelse ($imoveis as $imovel)
						<div class="ref-product" style="background: rgb(240, 240, 245); border-radius: 10px;">
							<div class="ref-media" style="padding-left: 10px; padding-right: 10px; padding-top:10px;">
                                @if (count($imovel->imagens) > 0)
                                    <img class="ref-image" style="border-radius: 5px;" src="/storage/images/{{$imovel->imagens[0]->imagem}}" loading="lazy"/>
                                @else
                                    <img class="ref-image" style="border-radius: 5px;" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" loading="lazy"/>
                                @endif
								<!--<div class="ref-promo-badge">Venda</div>-->
                                <!--<div class="ref-promo-badge">SAaaaLE</div>-->

                                <div class="ref-badge-container" style="padding: 10px;">
                                    <div class="ref-badge-venda" @if (!$imovel->isvenda)
                                        hidden                                    
                                    @endif>Venda</div>
                                    <div class="ref-badge-aluguel" @if (!$imovel->islocation)
                                        hidden                                    
                                    @endif>Aluguel</div>
                                </div>
							</div>
                            
							<div class="ref-product-data" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; padding-left: 10px; padding-right: 10px;">
                                <div class="ref-product-info" style="flex: 1;">
                                    <h5 class="ref-name" style="font-weight: bold;">{{ $imovel->titulo }}</h5>
                                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                        <img src="/img/icon-localizacao.png" alt="localizacao" width="16" height="16">
                                        <span>{{$imovel->endereco->bairro}}, {{$imovel->endereco->cidade->descricao}}, {{$imovel->endereco->cidade->uf}}</span>
                                    </div>
                                    <!--<p class="ref-excerpt">{{ $imovel->detalheimovel->descricao }}</p>-->
                                    <p style="font-size: 14px; line-height: 0.7; display: flex; flex-wrap: wrap; gap: 15px;">
                                        @if ($imovel->detalheImovel->metrosquadrados > 0)
                                            <span>Área: {{$imovel->detalheImovel->metrosquadrados}}m²</span>
                                        @endif

                                        @if ($imovel->detalheImovel->numeroquartos > 0)
                                            <span>Dormitórios: {{ $imovel->detalheImovel->numeroquartos }}</span>
                                        @endif

                                        @if ($imovel->detalheImovel->numerodevagas > 0)
                                            <span>Vagas de Garagem: {{ $imovel->detalheImovel->numerodevagas }}</span>
                                        @endif
                                    </p>
                                </div>                                
                                <div style="align-self: flex-end; width: 100%;">
                                @if($imovel->isvenda)
                                <div style="display: flex; justify-content: space-between; width: 100%; font-weight: bold; color: #32a850;">
                               
                                    <div style="text-align: left;">Venda:</div>
                                    <div style="text-align: right;">R${{ number_format($imovel->valorvenda, 2, ',', '.') }}</div>
                                
                                </div>
                                @endif
                                @if($imovel->islocation)
                                <div style="display: flex; justify-content: space-between; width: 100%; font-weight: bold; color: #32a850;">
                                        <div style="text-align: left;">Aluguel:</div>
                                        <div style="text-align: right;">R${{ number_format($imovel->valoraluguel, 2, ',', '.') }}</div>
                                </div>
                                @endif
                                </div>
                            </div>
							<div class="ref-addons">
                                <a class="ref-button preview-toggle w-100" style="text-align: center; border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" href="{{route('anuncio.visualizar', $imovel->id)}}">Visualizar</a>
                            </div>
						</div>
                    @empty
                    @endforelse
				</div>
			</div>
        </section>
        <script src="/js/personalizado.js"></script>        
    </main>
    <x-imovel.footer/>
</x-imovel.nav>