<x-imovel.nav>
   <main class="page landing-page">
      <section style="margin-right: 40px;margin-left: 40px;margin-top: 30px;padding: 12px;">
         <form action="/anuncio/salvar" method="POST" enctype="multipart/form-data">
         @csrf
         <div>
            <h1>Anunciar Imóvel</h1>
         </div>
         <div class="justify-content-between" style="display: flex;">
            <div class="text-start" style="padding-top: 0px;width: 45%;">
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Título</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="text" name="titulo" id="titulo" required></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Descrição</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="text" name="descricao" id="descricao" required></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Tipo de Imóvel</label></div>
                  <div class="col-xl-8 col-xxl-8">
                     <select class="form-select" name="tipoimovel" id="tipoimovel" required>
                        @foreach ($allTipoImoveis as $tipo)   
                        <option  value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>               
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-12 col-lg-12 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Tipo de Anúncio</label></div>
                  <div class="col-md-12 col-lg-12 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="margin-right: 20px;">
                        <input class="form-check-input" type="checkbox" id="formCheck-1" name="isvenda"><label class="form-check-label" for="formCheck-1">Venda</label></div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="checkbox" id="formCheck-2" name="islocacao"><label class="form-check-label" for="formCheck-2">Locação</label></div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-lg-12 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Valor da Venda</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="text" name="valorvenda" style="color: rgb(33, 37, 41);"></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Valor do Aluguel</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="text" name="valoraluguel"></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">CEP</label></div>
                  <div class="col-xl-8 col-xxl-8 justify-content-between" style="display: flex;"><input class="form-control" type="text" name="cep" id="cep" style="width: 70%;" required>
                     <button class="btn btn-primary" type="button" style="width: 25%;" id="buscarCep">Buscar</button>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Estado</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="text" name="estado" id="estado" required></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Cidade</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="text" name="cidade" id="cidade" required></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Bairro</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="text" name="bairro" id="bairro" required></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Rua</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="text" name="rua" id="rua" required></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Número</label></div>
                  <div class="col-xl-8 col-xxl-8"><input class="form-control" type="number" name="numero" id="numero" required pattern="[0-9]+" title="Por favor, insira somente números"></div>
               </div>
            </div>
            <div style="padding-top: 0px;width: 45%;">
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Quartos</label></div>
                  <div class="col-md-12 col-xl-8 col-xxl-8" style="display: flex;"><input class="form-control form-control-sm" type="number" min="1" max="10" name="quartos" required></div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-8 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Banheiros</label></div>
                  <div class="col-md-12 col-xl-8 col-xxl-8" style="display: flex;"><input class="form-control form-control-sm" type="number" min="1" max="10" name="banheiros" required></div>
               </div>   
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Mobilia</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                        <input class="form-check-input" type="radio" id="formCheck-1-1" name="mobliado" value="1" required><label class="form-check-label" for="formCheck-1-1">Mobiliado</label></input>
                     </div>
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                        <input class="form-check-input" type="radio" id="formCheck-1-2" name="mobliado" value="2" required><label class="form-check-label" for="formCheck-1-2">Semi Mobiliado</label></input>
                     </div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="radio" id="formCheck-1-3" name="mobliado" value="3" required><label class="form-check-label" for="formCheck-1-3">Sem Mobilia</label></input>
                     </div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-5 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Churrasqueira</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                        <input class="form-check-input" type="radio" id="churrasqueiraYes" name="churrasqueira" value="true" required><label class="form-check-label" for="churrasqueiraYes">Sim</label></input>
                     </div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="radio" id="churrasqueiraNo" name="churrasqueira" value="false" required><label class="form-check-label" for="churrasqueiraNo">Não</label></input>   
                     </div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Piscina</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                        <input class="form-check-input" type="radio" id="piscinaYes" name="piscina" value="true" required>
                        <label class="form-check-label" for="piscinaYes">Sim</label>
                     </div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="radio" id="piscinaNo" name="piscina" value="false" required>
                        <label class="form-check-label" for="piscinaNo">Não</label>
                     </div>
                  </div>
               </div>               
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Elevador</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                     <input class="form-check-input" type="radio" id="elevadorYes" name="elevador" value="true" required>
                     <label class="form-check-label" for="elevadorYes">Sim</label>
                  </div>
                     <div class="form-check align-self-center"><input class="form-check-input" type="radio" id="elevadorNo" name="elevador" value="false" required>
                     <label class="form-check-label" for="elevadorNo">Não</label>
                  </div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Internet</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                     <input class="form-check-input" type="radio" id="internetYes" name="internet" value="true">
                     <label class="form-check-label" for="internetYes">Sim</label>
                  </div>
                     <div class="form-check align-self-center"><input class="form-check-input" type="radio" id="internetNo" name="internet" value="false">
                     <label class="form-check-label" for="internetNo">Não</label>
                  </div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Salão de Festas</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                     <input class="form-check-input" type="radio" id="salaofestasYes" name="salaofestas" value="true">
                     <label class="form-check-label" for="salaofestasYes">Sim</label>
                  </div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="radio" id="salaofestasNo" name="salaofestas" value="false">
                        <label class="form-check-label" for="salaofestasNo">Não</label>
                     </div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Sacada</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                     <input class="form-check-input" type="radio" id="sacadaYes" name="sacada" value="true">
                     <label class="form-check-label" for="sacadaYes">Sim</label>
                  </div>
                     <div class="form-check align-self-center"><input class="form-check-input" type="radio" id="sacadaNo" name="sacada" value="false">
                     <label class="form-check-label" for="sacadaNo">Não</label>
                  </div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Lavanderia</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                     <input class="form-check-input" type="radio" id="lavanderiaYes" name="lavanderia" value="true">
                     <label class="form-check-label" for="lavanderiaYes">Sim</label>
                  </div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="radio" id="lavanderiaNo" name="lavanderia" value="false">
                        <label class="form-check-label" for="lavanderiaNo">Não</label></div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Ar Condicionado</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                     <input class="form-check-input" type="radio" id="arcondicionadoYes" name="arcondicionado" value="true">
                     <label class="form-check-label" for="arcondicionadoYes">Sim</label>
                  </div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="radio" id="arcondicionadoNo" name="arcondicionado" value="false">
                        <label class="form-check-label" for="arcondicionadoNo">Não</label>
                     </div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Area de Lazer</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                     <input class="form-check-input" type="radio" id="arealazerYes" name="arealazer" value="true">
                     <label class="form-check-label" for="arealazerYes">Sim</label>
                  </div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="radio" id="arealazerNo" name="arealazer" value="false">
                        <label class="form-check-label" for="arealazerNo">Não</label>
                     </div>
                  </div>
               </div>
               <div class="row" style="padding-top: 5px;">
                  <div class="col-md-7 col-lg-11 col-xl-4 col-xxl-4" style="height: 38px;"><label class="col-form-label">Estacionamento</label></div>
                  <div class="col-md-10 col-xl-8 col-xxl-8" style="display: flex;">
                     <div class="form-check align-self-center" style="padding-right: 23px;">
                     <input class="form-check-input" type="radio" id="estacionamentoYes" name="estacionamento" value="true">
                     <label class="form-check-label" for="estacionamentoYes">Sim</label>
                  </div>
                     <div class="form-check align-self-center">
                        <input class="form-check-input" type="radio" id="estacionamentoNo" name="estacionamento" value="false">
                        <label class="form-check-label" for="estacionamentoNo">Não</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div style="margin-top: 10px; margin-bottom: 10px;" id="divfotos" >
            <h3>Fotos do Imóvel</h3>
            <div id="fotos-container" style="display: flex; flex-wrap: wrap;">
               <div class="form-group col-md-12 col-lg-6 col-xl-3 col-xxl-3" style="display: block; margin: 5px;">                  

                  <!--<input type="text" class="form-control" id="descricao1" name="descricao1" placeholder="Descrição da foto" style="margin-top:5px">-->

                  <select class="form-select" name="descricao1" id="descricao1" required>
                        @foreach ($allLocaisImagem as $local)   
                        <option  value="{{ $local->id }}">{{ $local->descricao }}</option>
                        @endforeach
                  </select>

                  
                  <input type="file" class="form-control-file" id="foto1" name="foto1" style="margin-top:5px">
                  <button type="button" class="btn btn-danger btn-sm remove-foto" style="margin-top:5px">Remover</button>
               </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm add-foto" style="margin-top: 10px;">Nova Foto</button>
         </div>
         <button type="submit" class="btn btn-primary">Salvar</button>
         </form>
      </section>
   </main>
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function() {
          $("#buscarCep").click(function() {
              var cep = $("#cep").val();
              console.log(cep);
              if (cep) {
                  $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", function(data) {
                      if (!("erro" in data)) {
                          $("#rua").val(data.logradouro);
                          $("#bairro").val(data.bairro);
                          $("#cidade").val(data.localidade);
                          $("#estado").val(data.uf);
                      } else {
                          alert("CEP não encontrado.");
                      }
                  });
              } else {
                  alert("Informe um CEP válido.");
              }
          });
      });
   </script>

   <script>
           
      // Add a click event listener to the add photo button
      var addFotoButton = document.querySelector(".add-foto");
      addFotoButton.addEventListener("click", function() {
          // Get the current number of photos
          var numFotos = document.querySelectorAll(".form-group").length;
      
          // Create a new input group for the photo and description
          var newInputGroup = document.createElement("div");
         newInputGroup.classList.add("form-group");
         newInputGroup.classList.add("col-md-12");
         newInputGroup.classList.add("col-lg-6");
         newInputGroup.classList.add("col-xl-3");
         newInputGroup.classList.add("col-xxl-3");
      
          // Create a new file input for the photo
          var newFotoInput = document.createElement("input");
          newFotoInput.type = "file";
          newFotoInput.classList.add("form-control-file");
          newFotoInput.id = "foto" + (numFotos + 1);
          newFotoInput.name = "foto" + (numFotos + 1);
          newFotoInput.style = "margin-top:5px"
      
         

          // Create a new text input for the photo description
          var newDescricaoSelect = document.createElement("select");
         newDescricaoSelect.classList.add("form-select");
         newDescricaoSelect.name = "descricao" + (numFotos + 1);
         newDescricaoSelect.id = "descricao" + (numFotos + 1);
         newDescricaoSelect.required = true;

         @foreach ($allLocaisImagem as $local)   
            var newDescricaoOption = document.createElement("option");
            newDescricaoOption.value = "{{ $local->id }}";
            newDescricaoOption.textContent = "{{ $local->descricao }}";
            newDescricaoSelect.appendChild(newDescricaoOption);
         @endforeach

          // Create a new remove button for the input group
          var newRemoveButton = document.createElement("button");
          newRemoveButton.type = "button";
          newRemoveButton.classList.add("btn", "btn-danger", "btn-sm", "remove-foto");
          newRemoveButton.textContent = "Remover";
          newRemoveButton.style = "margin-top:5px"

          newInputGroup.style = "display: block; margin: 5px;"

          // Add the new inputs and remove button to the input group
          newInputGroup.appendChild(newDescricaoSelect);
          newInputGroup.appendChild(newFotoInput);          
          newInputGroup.appendChild(newRemoveButton);
      
          // Add the new input group to the container
          var fotosContainer = document.getElementById("fotos-container");
          fotosContainer.appendChild(newInputGroup);
      
          // Add a click event listener to the new remove button
          newRemoveButton.addEventListener("click", function() {
              // Get the input group to remove
              var inputGroup = newRemoveButton.parentNode;
      
              // Remove the input group from the container
              fotosContainer.removeChild(inputGroup);
          });
      });
      
      // Add a click event listener to the remove photo buttons
      var removeFotoButtons = document.querySelectorAll(".remove-foto");
      removeFotoButtons.forEach(function(button) {
          button.addEventListener("click", function() {
              // Get the input group to remove
              var inputGroup = button.parentNode;
      
              // Remove the input group from the container
              var fotosContainer = document.getElementById("fotos-container");
              fotosContainer.removeChild(inputGroup);
          });
      });
   </script>
   <x-imovel.footer/>
</x-imovel.nav>