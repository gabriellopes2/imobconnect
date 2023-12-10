@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="/register/salvar" method="post">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('Senha') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('Confirmar Senha') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                   value="{{ old('nome') }}" placeholder="{{ __('Nome') }}" required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="date" name="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror"
                   value="{{ old('data_nascimento') }}" placeholder="{{ __('Data de Nascimento') }}" required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('data_nascimento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="input-group mb-3">
            <input type="text" name="telefone" id="telefone" class="form-control @error('telefone') is-invalid @enderror"
                   value="{{ old('telefone') }}" placeholder="{{ __('Telefone') }}" required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('telefone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="text" name="cpf" id="cpf" class="form-control @error('cpf') is-invalid @enderror"
                   value="{{ old('cpf') }}" placeholder="{{ __('CPF') }}" required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('cpf')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="text" name="cnpj" id="cnpj" class="form-control @error('cnpj') is-invalid @enderror"
                   value="{{ old('cnpj') }}" placeholder="{{ __('CNPJ') }}" required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('cnpj')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="text" name="razao_social" class="form-control @error('razao_social') is-invalid @enderror"
                   value="{{ old('razao_social') }}" placeholder="{{ __('Razão Social') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-building {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('razao_social')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="text" name="nome_fantasia" class="form-control @error('nome_fantasia') is-invalid @enderror"
                   value="{{ old('nome_fantasia') }}" placeholder="{{ __('Nome Fantasia') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-building {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('nome_fantasia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#enderecoSection">
                <span class="fas fa-plus-circle"></span> Endereço
            </button>
        </div>

        <div class="card mb-3 collapse" id="enderecoSection">
            <div class="card-body">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" class="form-control" placeholder="Digite o CEP" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" class="form-control" placeholder="Digite o Estado" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" class="form-control" placeholder="Digite a Cidade" required>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" class="form-control" placeholder="Digite o Bairro" required>
                </div>
                <div class="form-group">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" class="form-control" placeholder="Digite a Rua" required>
                </div>
                <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" name="numero" class="form-control" placeholder="Digite o Número" required>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" class="form-control" placeholder="Digite o Complemento">
                </div>

            </div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="vendedor" id="vendedor" {{ old('vendedor') ? 'checked' : '' }}>

            <label class="form-check-label" for="vendedor">
                {{ __('Vendedor') }}
            </label>
        </div>

        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>
    </form>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Cleave('#cpf', {
                delimiters: ['.', '.', '-'],
                blocks: [3, 3, 3, 2],
                numericOnly: true
            });

            new Cleave('#cnpj', {
                delimiters: ['.', '.', '/', '-'],
                blocks: [2, 3, 3, 4, 2],
                numericOnly: true
            });

            document.getElementById('salvarContato').addEventListener('click', function () {
                document.querySelector('#contatoSection form').reset();
            });

            document.getElementById('gridContatos').addEventListener('click', function (event) {
                if (event.target.classList.contains('editarContato')) {
                    // Lógica para editar o contato na grid
                    // ...
                } else if (event.target.classList.contains('excluirContato')) {
                    // Lógica para excluir o contato na grid
                    // ...
                }
            });

    </script>
@stop
