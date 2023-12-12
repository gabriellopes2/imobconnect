<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Contato;
use App\Models\Cidade;
use App\Models\Pessoa;
use App\Models\User;
use App\Models\TipoContato;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {       
        
        DB::beginTransaction();
        try{              

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
        $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $pessoa->cnpj = preg_replace('/[^0-9]/', '', $request->cnpj);
        $pessoa->datanascimento = $request->data_nascimento;
        $pessoa->telefone = preg_replace('/[^0-9]/', '', $request->telefone);
        $pessoa->razaosocial = empty($request->razao_social) ? null : $request->razao_social;
        $pessoa->nomefantasia = empty($request->nome_fantasia) ? null : $request->nome_fantasia;
        $pessoa->isproprietario = $request->has('vendedor');
        $pessoa->idendereco = $endereco->id;
        $pessoa->idusuario = $usuario->id;
        $pessoa->save();
    
        DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
            return to_route('register');
        }
        
        
        return to_route('home');
   
   
    }
}
