<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoImovel;

class TipoImovelController extends Controller
{
    public function index()
    {
        $tipoImoveis = TipoImovel::query()->orderBy('descricao')->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('tipoimovel.index')
            ->with('tipoimoveis', $tipoImoveis);
    }

    public function create()
    {
        return view('tipoimovel.create');
    }
    
    public function store(Request $request)
    {
        $tipoImovel = new TipoImovel();
        $tipoImovel->descricao = $request->input('descricao');
        $tipoImovel->ativo = FALSE;
        if ($request->input('ativo'))
        {
            $tipoImovel->ativo = TRUE;
        }
        $tipoImovel->save();

        return to_route('tipoimovel.index')
            ->with('mensagem.sucesso', "Tipo de imóvel '{$tipoImovel->descricao}' adicionado com sucesso");
    }

    public function edit($id)
    {
        $tipoimovel = TipoImovel::find($id);

        return view('tipoimovel.edit')->with('tipoimovel', $tipoimovel);
    }

    public function update($id, Request $request)
    {
        $tipoimovel = TipoImovel::find($id);

    }

    public function destroy($id)
    {
        $tipoimovel = TipoImovel::find($id);
        $tipoimovel->delete();

        return to_route('tipoimovel.index')
            ->with('mensagem.sucesso', "Tipo de imóvel '{$tipoimovel->descricao}' removido com sucesso");
    }
}
