<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalheImovel extends Model
{
    use HasFactory;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detalheimovel';
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ismobiliado' ,
        'issemimobiliado',
        'numerobanheiros',
        'numeroquartos',
        'metrosquadrados',
        'descricao',
        'haselevador',
        'hasinternet',
        'hassalaodefestas',
        'hassacada',
        'haslavanderia',
        'hasarcondicionado',
        'hasareadelazer',
        'hasestacionamento',
        'numerodevagas',
        'isanimaispermitidos',
        'tipodepiso',
        'hasportaria',
        'observacoes',
        'ativo',
        'haschurrasqueira',
        'haspiscina',
        'hasquiosque',
        'iscercado'
    ];

    
    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

}
