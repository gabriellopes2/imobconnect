<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\Pessoa;
use App\Models\Interessado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('CheckAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        


        $imoveisDisponiveis = Imovel::with('detalheImovel', 'pessoa')->where('disponivel', true)->get();
        $imoveisVendidos = Interessado::where('comprou', true)->where('tiponegocio', 'Comprar')->get();
        $imoveisAlugados = Interessado::where('comprou', true)->where('tiponegocio', 'Alugar')->get();
        $clientes = Pessoa::with('usuario')->where('ativo', true)->get();
        
        return view('home')
            ->with('imoveisDisponiveis', $imoveisDisponiveis)
            ->with('imoveisVendidos', $imoveisVendidos)
            ->with('imoveisAlugados', $imoveisAlugados)
            ->with('clientes', $clientes);
    }
    
}