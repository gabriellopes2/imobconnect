<div class="card">
    <div class="card-header">
        <i class="fa fa-info-circle"></i>
        <h5>Preencha os campos e clique em Salvar</h5>
        <hr class="m-b-5">
    </div>

    <div class="card-body">

        <x-form.model route="tipoimovel" :model="$tipoimovel ?? null"/>

            @csrf
           
            <div class="container">
                <div class="row">
                    <label for="descricao" class="col-sm-2 col-form-label">Descrição: *</label>
                    <div class="col-md-9">
                        <input type="text" id="descricao" name="descricao" class="form-control" @isset($descricao)value="{{ $tipoimovel->descricao }}"@endisset>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Situação: *</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ativo" id="ativo1">
                        <label class="form-check-label" for="ativo1">
                            Sim
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ativo2" id="ativo2">
                        <label class="form-check-label" for="ativo2">
                            Não
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>