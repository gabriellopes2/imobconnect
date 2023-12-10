<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pessoa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'cnpj',
        'razaosocial',
        'nomefantasia',
        'isproprietario',
        'datanascimento',
        'idendereco',
        'ativo',
        'idusuario'
    ];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'idendereco', 'id');
    }

    public function imoveis()
    {
        return $this->hasMany(Imovel::class, 'idpessoa');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idusuario', 'id');
    }


}
