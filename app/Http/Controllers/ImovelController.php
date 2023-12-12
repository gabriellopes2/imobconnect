<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\DetalheImovel;
use App\Models\ImovelImagem;
use App\Models\TipoImovel;

class ImovelController extends Controller
{
    
    public function index()
    {
        // Substitua isso por uma consulta ao banco que carregue todos os imóveis com seus tipos
        $imoveis = Imovel::with('tipo', 'pessoa')->where('ativo', false)->orderBy('id')->get();

        return view('imovel.index', compact('imoveis'));
    }

    public function create()
    {
        $allTipoImoveis = TipoImovel::orderBy('descricao')->get();

        return view('imovel.create', [
            'allTipoImoveis' => $allTipoImoveis
        ]);
        //return view('imovel.create');
    }
   

    public function store(Request $request)
    {
        
        $imovel = new Imovel();
               

        return to_route('imovel.index')
            ->with('mensagem.sucesso', "Imóvel adicionado com sucesso");
    }

    public function aprovar($id)
    {
        $imovel = Imovel::find($id);
        $imovel->ativo = true;
        $imovel->save();

        return to_route('imovel.index')
            ->with('mensagem.sucesso', "Imóvel aprovado com sucesso");
    }
   
    public function destroy($id)
    { 
        $imagens = ImovelImagem::where('idimovel', $id)->get();
        foreach ($imagens as $imagem) {
            $imagem->delete();
        }

        $imovel = Imovel::find($id);

        $detalheImovel = DetalheImovel::find($imovel->iddetalheimovel);
        $imovel->delete();
        $detalheImovel->delete();

        return to_route('imovel.index')
            ->with('mensagem.sucesso', "Imóvel removido com sucesso");
    }
}