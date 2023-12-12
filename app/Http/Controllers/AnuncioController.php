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
use App\Models\Interessado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class AnuncioController extends Controller
{
    public function anunciar()
    {
        $allTipoImoveis = TipoImovel::orderBy('descricao')->get();
        $allLocaisImagem = LocalImagem::orderBy('descricao')->get();

        return view('anuncio.anunciar', [
            'allTipoImoveis' => $allTipoImoveis,
            'allLocaisImagem' => $allLocaisImagem
        ]);
    }

    public function editar($id)
    {
        $allTipoImoveis = TipoImovel::orderBy('descricao')->get();
        $allLocaisImagem = LocalImagem::orderBy('descricao')->get();
        $pessoaLogada = Auth::user()->pessoa;
        $imovel = Imovel::with('tipo', 'endereco.cidade', 'detalheimovel')->where('id', $id)->where('idpessoa', $pessoaLogada->id)->first();

        if ($imovel == null) {
            return to_route('anuncio.meusimoveis');
        }

        return view('anuncio.anunciar', [
            'allTipoImoveis' => $allTipoImoveis,
            'allLocaisImagem' => $allLocaisImagem,
            'imovel' => $imovel
        ]);
    }

    public function anuncios(Request $request)
    {
        $idTipoImovel = $request->input('idtipoimovel');
        $idCidade = $request->input('idcidade');
        $bairro = $request->input('bairro');
        $numeroQuartos = $request->input('numeroquartos');
        $numerodeVagas = $request->input('numerodevagas');
        $valorMinVenda = $request->input('valorminvenda');
        $valorMaxVenda = $request->input('valormaxvenda');
        $valorMinAluguel = $request->input('valorminaluguel');
        $valorMaxAluguel = $request->input('valormaxaluguel');
        $tipoAnuncio = $request->input('tipoanuncio');

        $cidades = Cidade::where('uf', "RS")->orderBy('descricao')->get();
        $allTipoImoveis = TipoImovel::orderBy('descricao')->get();

        $imoveis = Imovel::with('endereco.cidade', 'detalheImovel')->where('ativo', true)->where('disponivel', true)->get();

        $imoveisVenda = $imoveis->filter(function ($imovel) {
            return $imovel->isvenda === true;
        });

        $imoveisAluguel = $imoveis->filter(function ($imovel) {
            return $imovel->islocation === true;
        });

        $maxPrecoVenda = round(($imoveisVenda->max('valorvenda') / 5000) + 1, 0, PHP_ROUND_HALF_UP) * 5000;
        $minPrecoVenda = round(($imoveisVenda->min('valorvenda') / 5000) - 1, 0, PHP_ROUND_HALF_DOWN) * 5000;
        $maxPrecoAluguel = round(($imoveisAluguel->max('valoraluguel') / 100) + 1, 0, PHP_ROUND_HALF_UP) * 100;
        $minPrecoAluguel = round(($imoveisAluguel->min('valoraluguel') / 100) - 1, 0, PHP_ROUND_HALF_DOWN) * 100;
        $numeroMaxQuartos = $imoveis->max('detalheImovel.numeroquartos');
        $numeroMaxVagas = $imoveis->max('detalheImovel.numerodevagas');

        $imoveisFiltrados = $imoveis->filter(function ($imovel) use ($idTipoImovel, $idCidade, $bairro, $numeroQuartos, $numerodeVagas, $valorMinVenda, $valorMaxVenda, $valorMinAluguel, $valorMaxAluguel, $tipoAnuncio) {
            $tipoImovelValido = $idTipoImovel ? $imovel->idtipoimovel == $idTipoImovel : true;
            $cidadeValida = $idCidade ? $imovel->endereco->idcidade == $idCidade : true;
            $bairroValido = $bairro ? $imovel->endereco->bairro == $bairro : true;
            $quartosValidos = $numeroQuartos ? $imovel->detalheImovel->numeroquartos == $numeroQuartos : true;
            $vagasValidas = $numerodeVagas ? $imovel->detalheImovel->numerodeVagas == $numerodeVagas : true;
            $valorMinVendaValido = $valorMinVenda ? $imovel->valorvenda >= $valorMinVenda : true;
            $valorMaxVendaValido = $valorMaxVenda ? $imovel->valorvenda <= $valorMaxVenda : true;
            $valorMinVendaValido = ($tipoAnuncio == "Aluguel") ? true : $valorMinVendaValido; 
            $valorMaxVendaValido = ($tipoAnuncio == "Aluguel") ? true : $valorMaxVendaValido; 
            $valorMinAluguelValido = $valorMinAluguel ? $imovel->valoraluguel >= $valorMinAluguel : true;
            $valorMaxAluguelValido = $valorMaxAluguel ? $imovel->valoraluguel <= $valorMaxAluguel : true;
            $valorMinAluguelValido = ($tipoAnuncio == "Venda") ? true : $valorMinAluguelValido; 
            $valorMaxAluguelValido = ($tipoAnuncio == "Venda") ? true : $valorMaxAluguelValido; 
            $tipoAnuncioValido = $tipoAnuncio ? ($tipoAnuncio == "Aluguel" ? $imovel->islocation : $imovel->isvenda) : true;

            return $tipoImovelValido && $cidadeValida && $bairroValido && $quartosValidos && $vagasValidas && $valorMinVendaValido && $valorMaxVendaValido && $valorMinAluguelValido && $valorMaxAluguelValido && $tipoAnuncioValido;
        });
        return view('anuncio.anuncios')
            ->with('allTipoImoveis', $allTipoImoveis)
            ->with('imoveis', $imoveisFiltrados)
            ->with('cidades', $cidades)
            ->with('filtro', $request->all())
            ->with('maxPrecoVenda', $maxPrecoVenda)
            ->with('minPrecoVenda', $minPrecoVenda)
            ->with('maxPrecoAluguel', $maxPrecoAluguel)
            ->with('minPrecoAluguel', $minPrecoAluguel)
            ->with('numeroMaxQuartos', $numeroMaxQuartos)
            ->with('numeroMaxVagas', $numeroMaxVagas);
    }

    public function meusimoveis()
    {
        $pessoaLogada = Auth::user()->pessoa;
        $imoveis = Imovel::with('interessados.pessoa.endereco', 'interessados.pessoa.usuario')->where('idpessoa', $pessoaLogada->id)->get();

        return view('anuncio.meusimoveis')
            ->with('imoveis', $imoveis);
    }

    public function definecomprador(Request $request)
    {
        DB::beginTransaction();
        try{
            $interesse = Interessado::where('id', $request->idinteressado)->get()->first();
            if ($interesse == null) {
                return to_route('anuncio.meusimoveis');
            }

            $interesse->comprou = true;
            $interesse->save();

            $imovel = Imovel::where('id', $interesse->idimovel)->get()->first();    
            $imovel->disponivel = false;
            $imovel->save();
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
            return to_route('anuncio.meusimoveis');
        }

        return to_route('anuncio.meusimoveis');
    }

    public function visualizar($id)
    {
        $allTipoImoveis = TipoImovel::orderBy('descricao')->get();
        $imovel = Imovel::with('tipo', 'endereco', 'detalheimovel', 'imagens.localimagem')->where('ativo', true)->where('id', $id)->first();

        $entrouContato = false;

        if (Auth::check()) {
            $interessado = Interessado::where('idimovel', $id)->where('idpessoa', Auth::user()->pessoa->id)->first();
            if ($interessado != null) {
            $entrouContato = true;
            }
        }
        return view('anuncio.visualizar')
            ->with('imovel', $imovel)
            ->with('entrouContato', $entrouContato);
    }

    public function contato(Request $request)
    {
        if (Interessado::where('idimovel', $request->idimovel)->where('idpessoa', Auth::user()->pessoa->id)->first() != null) {
            return to_route('anuncio.visualizar', ['id' => $request->idimovel]);
        }

        //Se não teve opção de escolher o tipo de negócio, é porque só tem um tipo de negócio para o imóvel
        //Então busco no banco qual vai ser o tipo
        if ($request->tiponegocio == null) {
            $imovel = Imovel::where('id', $request->idimovel)->select('islocation')->first();
            if ($imovel && $imovel->islocation) {
                $request->tiponegocio = "Alugar";
            } else {
                $request->tiponegocio = "Comprar";
            }
        }
        
        $interessado = new Interessado();
        $interessado->idimovel = $request->idimovel;
        $interessado->idpessoa = Auth::user()->pessoa->id;
        $interessado->comprou = false;        
        $interessado->tiponegocio = $request->tiponegocio;
        $interessado->save();

        return to_route('anuncio.visualizar', ['id' => $request->idimovel]);
    }

    public function store(Request $request)
    {        
        DB::beginTransaction();
        try{

        
        $teste = json_encode($request->all());
        $endereco = new Endereco();
        $endereco->cep = str_replace(' ', '', $request->cep);
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $cidade = Cidade::where('descricao', $request->cidade)->where('uf', $request->estado)->first();
        $endereco->idcidade = $cidade->id;
        $teste .= "<br><br>" . json_encode($endereco);
        $endereco->save();

        $detalhes = new DetalheImovel();
        $detalhes->ismobiliado = $request->mobilia == "1" ? true : false;
        $detalhes->issemimobiliado = $request->mobilia == "2" ? true : false;
        $detalhes->numerobanheiros = $request->banheiros;
        $detalhes->numeroquartos = $request->quartos;
        $detalhes->metrosquadrados = $request->metrosquadrados;
        $detalhes->descricao = $request->descricao;
        $detalhes->haselevador = $request->has('elevador');
        $detalhes->hasinternet = $request->has('internet');
        $detalhes->hassalaodefestas = $request->has('saladefestas');
        $detalhes->hassacada = $request->has('sacada');
        $detalhes->haslavanderia = $request->has('lavanderia');
        $detalhes->hasarcondicionado = $request->has('arcondicionado');
        $detalhes->hasareadelazer = $request->has('areadelazer');
        $detalhes->numerodevagas = $request->numerodevagas;
        $detalhes->isanimaispermitidos = true;
        $detalhes->tipodepiso = "";
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
        DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return to_route('anuncio.anunciar');
        }
        //return $teste;
        return to_route('anuncio.anuncios')
            ->with('mensagem.sucesso', "Imóvel adicionado com sucesso");
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
        $imovel = Imovel::where('id', $request->idimovel)->first();
        $imovel->titulo = $request->titulo;
        $imovel->idtipoimovel = $request->tipoimovel;
        $imovel->islocation = $request->has('islocacao');
        $imovel->isvenda = $request->has('isvenda');
        $imovel->valoraluguel = $request->valoraluguel == null ? 0 : $request->valoraluguel;
        $imovel->valorvenda = $request->valorvenda == null ? 0 : $request->valorvenda;
        $imovel->ativo = true;
        $imovel->idpessoa = Auth::user()->pessoa->id;
        $imovel->save();

        $endereco = Endereco::where('id', $imovel->idendereco)->first();
        $endereco->cep = str_replace(' ', '', $request->cep);
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $cidade = Cidade::where('descricao', $request->cidade)->where('uf', $request->estado)->first();
        $endereco->idcidade = $cidade->id;
        $endereco->save();

        $detalhes = DetalheImovel::where('id', $imovel->iddetalheimovel)->first();
        $detalhes->ismobiliado = $request->mobilia == "1" ? true : false;
        $detalhes->issemimobiliado = $request->mobilia == "2" ? true : false;
        $detalhes->numerobanheiros = $request->banheiros;
        $detalhes->numeroquartos = $request->quartos;
        $detalhes->metrosquadrados = $request->metrosquadrados;
        $detalhes->numerodevagas = $request->numerodevagas;
        $detalhes->descricao = $request->descricao;
        $detalhes->haselevador = $request->has('elevador');
        $detalhes->hasinternet = $request->has('internet');
        $detalhes->hassalaodefestas = $request->has('saladefestas');
        $detalhes->hassacada = $request->has('sacada');
        $detalhes->haslavanderia = $request->has('lavanderia');
        $detalhes->hasarcondicionado = $request->has('arcondicionado');
        $detalhes->hasareadelazer = $request->has('areadelazer');
        $detalhes->hasquiosque = $request->has('quiosque');
        $detalhes->haschurrasqueira = $request->has('churrasqueira');
        $detalhes->haspiscina = $request->has('piscina');
        $detalhes->iscercado = $request->has('cercado');
        $detalhes->save();
        DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
            return to_route('anuncio.meusimoveis');
        }

        return to_route('anuncio.meusimoveis');
    }
}
