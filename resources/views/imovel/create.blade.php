@extends('adminlte::page')

@section('content')

<div class="card">
    <div class="card-header">
        <i class="fa fa-info-circle"></i>
        <h5>Preencha os campos e clique em Salvar</h5>
        <hr class="m-b-5">
    </div>

    <div class="card-body">

    <x-form.model route="imovel" :model="$imovel ?? null" />
    @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tipoimovel">Tipo de imóvel: *</label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <select id="tipoimovel" name="tipoimovel" class="form-control">
                            <option value="" disabled selected>Selecione:</option>
                            @foreach ($allTipoImoveis as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tipoanuncio">Tipo de Anúncio: *</label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tipoanuncio_venda" id="tipoanuncio_venda">
                            <label class="form-check-label mr-4" for="tipoanuncio_venda">Venda</label>
                            <input class="form-check-input" type="checkbox" name="tipoanuncio_locacao" id="tipoanuncio_locacao">
                            <label class="form-check-label" for="tipoanuncio_locacao">Locação</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">Preço de Venda: *</label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" class="form-control" id="valorvenda" name="valorvenda" placeholder="0000.00" onkeypress="return isNumberKey(event)">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">Valor do Aluguel: *</label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="valoraluguel" name="valoraluguel">
                    </div>
                </div>
            </div>

            <!-- Restante do formulário -->

            <fieldset class="border p-4 mx-auto mt-4">
                <legend class="text-center">Dados de Endereço</legend>

                <div class="form-group">
                    <label for="cep_endereco">CEP: *</label>
                    <input type="text" class="form-control" id="cep_endereco" name="cep_endereco">
                </div>

                <div class="form-group">
                    <label for="logradouro">Logradouro: *</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro">
                </div>

                <div class="form-group">
                    <label for="bairro">Bairro: *</label>
                    <input type="text" class="form-control" id="bairro" name="bairro">
                </div>

                <div class="form-group">
                    <label for="cidade">Cidade: *</label>
                    <input type="text" class="form-control" id="cidade" name="cidade">
                </div>

                <div class="form-group">
                    <label for="estado">Estado: *</label>
                    <input type="text" class="form-control" id="estado" name="estado">
                </div>

                <!-- Botão de envio -->
                <button type="button" class="btn btn-primary" id="buscarCep">Buscar CEP</button>
            </fieldset>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#buscarCep").click(function() {
            var cep = $("#cep").val();
            if (cep) {
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", function(data) {
                    if (!("erro" in data)) {
                        $("#logradouro").val(data.logradouro);
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
    document.getElementById('tipoimovel').addEventListener('focus', function() {
        this.querySelector('option[value=""]').remove();
    });
</script>
<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var inputValue = document.getElementById("valorvenda").value;
    var regex = /^\d+(\.\d{0,2})?$/; // Permite apenas números com até 2 casas decimais

    if (charCode !== 46 && charCode > 31 && (charCode < 48 || charCode > 57) || !regex.test(inputValue + String.fromCharCode(charCode))) {
        return false;
    }

    return true;
}
</script>
@endsection