<x-imovel.nav>
<main class="page landing-page">
        <section style="padding: 0px;margin: 10px;margin-right: 40px;margin-left: 40px;">
        <div>
            <h1>Meus Imóveis</h1>
         </div>
            <div data-reflow-type="product-list" data-reflow-order="date_desc" style="padding: 0px;margin: 0px;">
                <div class="reflow-product-list">
                    <div class="ref-products">
                        @foreach ($imoveis as $imovel)
                        <div class="ref-imovel">
                            <div class="ref-product">
                                @if (count($imovel->imagens) > 0)
                                    <div class="ref-media"><img class="ref-image" src="/storage/images/{{$imovel->imagens[0]->imagem}}" loading="lazy" />
                                    </div>
                                @else
                                    <div class="ref-media"><img class="ref-image" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" loading="lazy" />                                    
                                    </div>
                                @endif
                                <div class="ref-product-data">
                                    <div class="ref-product-info">
                                        <h5 class="ref-name">{{$imovel->titulo}}</h5>
                                        <p class="ref-excerpt">{{$imovel->detalheimovel->descricao}}</p>                                        
                                    </div>
                                </div>

                                <div class="ref-addons" style="display: flex; flex-direction: column; align-items: stretch;">
                                    <a class="ref-button preview-toggle" href="#" style="text-align: center; padding: 10px; margin-bottom: 10px;">Editar Imóvel</a>
                                    <a class="ref-button preview-toggle" onclick="toggleGrid('grid{{$loop->index}}', this)" href="#" style="text-align: center; padding: 10px;">Mostrar Interessados</a>
                                </div>
                            </div>  

                            <div class="ref-grid" id="grid{{$loop->index}}" style="display: grid; grid-template-rows: repeat(3, auto); gap: 0px; padding: 0px;">
                                <!-- Linha 1 -->
                                <div class="grid-row" style="background-color: #f0f0f0;">
                                    <!-- Outras colunas -->
                                    <div class="grid-item">Nome</div>
                                    <div class="grid-item">Telefone</div>
                                    <div class="grid-item">Email</div>
                                </div>
                                <div class="grid-row" style="background-color: #f0f0f0;">
                                    <!-- Outras colunas -->
                                    <div class="grid-item">Everton</div>
                                    <div class="grid-item">(99) 9999-9999</div>
                                    <div class="grid-item">everton@mail.com</div>
                                    <!-- Última coluna -->
                                    <div class="grid-item">
                                    <!-- O botão é ocultado até que a linha seja passada com o mouse -->
                                    <button class="define-comprador">Definir como comprador</button>
                                    </div>
                                </div>
                                <div class="grid-row" style="background-color: #f0f0f0;">
                                    <!-- Outras colunas -->
                                    <div class="grid-item">Everton</div>
                                    <div class="grid-item">(99) 9999-9999</div>
                                    <div class="grid-item">everton@mail.com</div>
                                    <!-- Última coluna -->
                                    <div class="grid-item">
                                    <!-- O botão é ocultado até que a linha seja passada com o mouse -->
                                    <button class="define-comprador">Definir como comprador</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @if ( !count($imoveis) > 0 )
                            <div class="alert alert-warning">
                                Você ainda não possui imóveis anunciados!
                            </div>
                        @endif
                    </div>
                    <div class="ref-product-preview">
                        <div class="ref-product-preview-header">
                            <div class="ref-title"></div>
                            <div class="ref-close-button">×</div>
                        </div>
                        <div class="ref-product-preview-content"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="/js/Simple-Slider-swiper-bundle.min.js"></script>
    <script src="/js/Simple-Slider.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/bs-init.js"></script>
    <script src="/js/baguetteBox.min.js"></script>
    <script src="/js/vanilla-zoom.js"></script>
    <script src="/js/theme.js"></script>

    <script>
	function toggleGrid(gridId, button) {
		var grid = document.getElementById(gridId);
		if (grid.classList.contains('open')) {
			grid.classList.remove('open');
			button.textContent = "Mostrar Interessados";
			grid.style.maxHeight = '0px'; // Define a altura máxima para 0 para ocultar a grid
		} else {
			grid.classList.add('open');
			button.textContent = "Ocultar Interessados";
			// Define a altura máxima para a altura total do conteúdo para mostrar a grid
			grid.style.maxHeight = grid.scrollHeight + "px";
		}
	}

	</script>
	
	<style>
  .grid-row:hover .define-comprador {
    visibility: visible; /* O botão se torna visível quando a linha é passada com o mouse */
  }

  .define-comprador {
    visibility: hidden; /* O botão é ocultado inicialmente */
    position: absolute;
    right: 10px;
    top: 50%; /* Centraliza verticalmente */
    transform: translateY(-50%); /* Ajuste fino da centralização vertical */
  }
  
  .grid-row {
    position: relative; /* Necessário para a posição absoluta do botão */
    padding: 10px; /* Espaçamento */
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    align-items: center; /* Centraliza os itens da linha verticalmente */
  }
  
    .ref-grid {
    overflow: hidden; /* Garante que o conteúdo seja recortado durante a transição */
    max-height: 0; /* Começa com a grid oculta */
    transition: max-height 0.5s ease-in-out; /* Suaviza a transição da altura máxima */
  }

  .ref-grid.open {
    max-height: 500px; /* Altura máxima esperada para a grid (ajuste conforme necessário) */
  }
</style>
</x-imovel.nav>