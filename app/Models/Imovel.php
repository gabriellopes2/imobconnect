<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'imovel';
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'iddetalheimovel',
        'idtipoimovel',
        'idendereco',
        'islocation',
        'isvenda',
        'valoraluguel',
        'valorvenda',
        'ativo',
        'titulo',
        'disponivel'
    ];
    
    public function tipo()
    {
        return $this->belongsTo(TipoImovel::class, 'idtipoimovel', 'id');
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'idendereco', 'id');
    }
 
    public function imagens()
    {
        return $this->hasMany(ImovelImagem::class, 'idimovel');
    }

    public function interessados()
    {
        return $this->hasMany(Interessado::class, 'idimovel');
    }

    public function detalheImovel()
    {
        return $this->belongsTo(DetalheImovel::class, 'iddetalheimovel', 'id');
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'idpessoa');
    }
}
