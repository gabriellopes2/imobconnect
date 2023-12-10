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
  lowerValueLabel.textContent = "R$" + lowerSlider.value;
  upperValueLabel.textContent = "R$" + upperSlider.value;

  adjustFontSize('lower-value-venda');
  adjustFontSize('upper-value-venda');
  adjustFontSize('lower-value-aluguel');
  adjustFontSize('upper-value-aluguel');
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