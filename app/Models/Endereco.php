<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'endereco';
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cep',
        'rua',
        'bairro',
        'numero',
        'complemento',
        'idcidade',
        'ativo'
    ];

    // Relacionamento com imóveis
    public function imoveis()
    {
        return $this->hasMany(Imovel::class, 'idendereco', 'id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'idcidade', 'id');
    }
}
