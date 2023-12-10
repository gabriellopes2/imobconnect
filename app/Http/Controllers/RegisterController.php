<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Contato;
use App\Models\Cidade;
use App\Models\Pessoa;
use App\Models\User;
use App\Models\TipoContato;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {        
        $teste = json_encode($request->all());

        $endereco = new Endereco();
        $endereco->cep = $request->cep;
        $endereco->rua = $request->rua;
        $endereco->bairro = $request->bairro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        $cidade = Cidade::where('descricao', $request->cidade)->first();
        $endereco->idcidade = $cidade->id;
        $endereco ->save();

        $usuario = new User();
        $usuario->email = $request->email;
        $usuario->password = password_hash($request->password, PASSWORD_BCRYPT);
        $usuario->save();

        $pessoa = new Pessoa();
        $pessoa->nome = $request->nome;
        $pessoa->cpf = str_replace(['.', '-'], '', $request->cpf);
        $pessoa->cnpj = str_replace(['.', '/', '-'], '', $request->cnpj);
        $pessoa->datanascimento = $request->data_nascimento;
        $pessoa->telefone = $request->telefone;
        $pessoa->razaosocial = $request->razao_social;
        $pessoa->nomefantasia = $request->nome_fantasia;
        $pessoa->isproprietario = $request->has('vendedor');
        $pessoa->idendereco = $endereco->id;
        $pessoa->idusuario = $usuario->id;
        $pessoa->save();
        
        
        //return $teste;
        return to_route('home');
        //    ->with('mensagem.sucesso', "Imóvel adicionado com sucesso");
   
   
    }
}
