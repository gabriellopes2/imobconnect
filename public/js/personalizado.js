function updateSlider(slider) {
  // Identificar se estamos lidando com venda ou aluguel
  const isVenda = slider.classList.contains('venda');
  
  // Selecionar os elementos corretos com base no tipo
  const lowerSlider = isVenda ? document.getElementById('lower') : document.getElementById('lower2');
  const upperSlider = isVenda ? document.getElementById('upper') : document.getElementById('upper2');
  const lowerVal = parseInt(lowerSlider.value);
  const upperVal = parseInt(upperSlider.value);
  const stepVal = parseInt(lowerSlider.step); // Assume que ambos os sliders têm o mesmo valor de 'step'

  if (upperVal < lowerVal + stepVal) {
    lowerSlider.value = upperVal - stepVal;
    upperSlider.value = lowerVal + stepVal;
  }

  // Atualizar os valores de exibição
  const lowerValueLabel = isVenda ? document.getElementById('lower-value-venda') : document.getElementById('lower-value-aluguel');
  const upperValueLabel = isVenda ? document.getElementById('upper-value-venda') : document.getElementById('upper-value-aluguel');  
  if (lowerSlider.value > lowerSlider.min) {
    lowerValueLabel.textContent = "Valor Min. R$" + lowerSlider.value;
  }
  else
  {
    lowerValueLabel.textContent = "Sem Valor Min.";
  }
  if (upperSlider.value < upperSlider.max) {
    upperValueLabel.textContent = "Valor Max. R$" + upperSlider.value;
  }
  else
  {
    upperValueLabel.textContent = "Sem Valor Max.";
  }
}

// Event listeners para venda
document.getElementById('lower').addEventListener('input', function() { updateSlider(this); });
document.getElementById('upper').addEventListener('input', function() { updateSlider(this); });

// Event listeners para aluguel
document.getElementById('lower2').addEventListener('input', function() { updateSlider(this); });
document.getElementById('upper2').addEventListener('input', function() { updateSlider(this); });

// Inicialização
updateSlider(document.getElementById('lower'));
updateSlider(document.getElementById('lower2'));

function adjustFontSize(containerId) {
  const container = document.getElementById(containerId);
  if (!container) {
    console.error("Elemento não encontrado: " + containerId);
    return;
  }

  let fontSize = 18; // Tamanho inicial da fonte
  let decrement = 0.5; // Quanto reduzir a fonte a cada tentativa
  let minHeight = 10; // Tamanho mínimo da fonte

  container.style.fontSize = fontSize + 'px';

  while (container.scrollWidth > container.offsetWidth && fontSize > minHeight) {
    fontSize -= decrement;
    container.style.fontSize = fontSize + 'px';
  }
}
//

//ajuste filtro
document.addEventListener('DOMContentLoaded', (event) => {
  var form = document.getElementById('filtroForm');
  if (form) {
      form.addEventListener('submit', function(event) {
          var elementos = this.elements;

          for (var i = 0; i < elementos.length; i++) {
              // Verifica se o elemento é um input range com um ID específico e seu valor é igual ao mínimo
              if (elementos[i].type === 'range' && (elementos[i].id === 'lower' || elementos[i].id === 'lower2') && elementos[i].value === elementos[i].min) {
                elementos[i].name = '';
            }
            // Verifica se o elemento é um input range com um ID diferente e seu valor é igual ao máximo
            else if (elementos[i].type === 'range' && (elementos[i].id === 'upper' || elementos[i].id === 'upper2') && elementos[i].value === elementos[i].max) {
                elementos[i].name = '';
            }
            // Verifica se o elemento está vazio
            else if (elementos[i].name && !elementos[i].value) {
                elementos[i].name = '';
            }
          }
      });
  }
});