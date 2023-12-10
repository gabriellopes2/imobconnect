<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\DetalheImovel;
use App\Models\TipoImovel;
use App\Models\Endereco;
use App\Models\Cidade;
use App\Models\ImovelImagem;
use App\Models\LocalImagem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class AnuncioController extends Controller
{
    public function anunciar()
    {
        $allTipoImoveis = TipoImovel::orderBy('descricao')->get();
        $allLocaisImagem = LocalImagem::orderBy('descricao')->get();
        $cidades = Cidade::orderBy('descricao')->get();

        return view('anuncio.anunciar', [
            'allTipoImoveis' => $allTipoImoveis,
            'allLocaisImagem' => $allLocaisImagem
        ]);
    }

    public function anuncios()
    {
        $allTipoImoveis = TipoImovel::orderBy('descricao')->get();
        $imoveis = Imovel::where('ativo', true)->get();
        $quantidadeMaxQuartos = DB::table('detalheimovel')
                                    ->select('numeroquartos')
                                    ->orderby('numeroquartos', 'desc')
                                    ->first();

        return view('anuncio.anuncios')
            ->with('allTipoImoveis', $allTipoImoveis)
            ->with('imoveis', $imoveis)
            ->with('quantidadeMaxQuartos', $quantidadeMaxQuartos);
    }

    public function meusimoveis()
    {
        $pessoaLogada = Auth::user()->pessoa;
        $imoveis = Imovel::where('idpessoa', $pessoaLogada->id)->get();

        return view('anuncio.meusimoveis')
            ->with('imoveis', $imoveis);
    }


    public function visualizar($id)
    {
        $allTipoImoveis = TipoImovel::orderBy('descricao')->get();
        $imovel = Imovel::with('tipo', 'endereco', 'detalheimovel', 'imagens.localimagem')->where('ativo', true)->where('id', $id)->first();

        return view('anuncio.visualizar')
            ->with('imovel', $imovel);
    }


    public function store(Request $request)
    {        
        $teste = json_encode($request->all());

        $endereco = new Endereco();
        $endereco->cep = str_replace(' ', '', $request->cep);
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $cidade = Cidade::where('descricao', $request->cidade)->first();
        $endereco->idcidade = $cidade->id;
        $teste .= "<br><br>" . json_encode($endereco);
        $endereco->save();

        $detalhes = new DetalheImovel();
        $detalhes->ismobiliado = $request->mobilia == "1" ? true : false;
        $detalhes->issemimobiliado = $request->mobilia == "2" ? true : false;
        $detalhes->numerobanheiros = $request->banheiros;
        $detalhes->numeroquartos = $request->quartos;
        $detalhes->metrosquadrados = 0;
        $detalhes->descricao = $request->descricao;
        $detalhes->haselevador = $request->has('elevador');
        $detalhes->hasinternet = $request->has('internet');
        $detalhes->hassalaodefestas = $request->has('saladefestas');
        $detalhes->hassacada = $request->has('sacada');
        $detalhes->haslavanderia = $request->has('lavanderia');
        $detalhes->hasarcondicionado = $request->has('arcondicionado');
        $detalhes->hasareadelazer = $request->has('areadelazer');
        $detalhes->hasestacionamento = $request->has('estacionamento');
        $detalhes->numerodevagas = 0;
        $detalhes->isanimaispermitidos = true;
        $detalhes->tipodepiso = "";
        $detalhes->hasportaria = $request->has('portaria');
        $detalhes->observacoes = "";
        $detalhes->ativo = true;
        $detalhes->haschurrasqueira = $request->has('churrasqueira');
        $detalhes->haspiscina = $request->has('piscina');
        $detalhes->hasquiosque = $request->has('quiosque');
        $detalhes->iscercado = $request->has('cercado');
        $teste .= "<br><br>" . json_encode($detalhes);
        $detalhes->save();

        $imovel = new Imovel();
        $imovel->titulo = $request->titulo;
        $imovel->idtipoimovel = $request->tipoimovel;
        $imovel->iddetalheimovel = $detalhes->id;
        $imovel->idendereco = $endereco->id;
        $imovel->islocation = $request->has('islocacao');
        $imovel->isvenda = $request->has('isvenda');
        $imovel->valoraluguel = $request->valoraluguel == null ? 0 : $request->valoraluguel;
        $imovel->valorvenda = $request->valorvenda == null ? 0 : $request->valorvenda;
        $imovel->ativo = true;
        $imovel->idpessoa = Auth::user()->pessoa->id;
        $teste .= "<br><br>" . json_encode($imovel);
        $imovel->save();

        $i = 1;
        while (request()->hasFile('foto'.$i) && request()->has('descricao'.$i)) {

            $requestImage = request()->file('foto'.$i);
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('storage/images'), $imageName);

            $foto = new ImovelImagem();
            $foto->idimovel = $imovel->id;
            $foto->imagem = $imageName;
            $foto->idlocalimagem = request()->input('descricao'.$i);
            $foto->descricao = "";
            $teste .= "<br><br>" . json_encode($foto);
            $foto->save();
            $i++;
        }

        //return $teste;
        return to_route('anuncio.anuncios')
            ->with('mensagem.sucesso', "Imóvel adicionado com sucesso");
    }
}
