<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoImovel extends Model
{
    use HasFactory;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipoimovel';
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'descricao',
        'ativo'
    ];

    // Relacionamento com imóveis
    public function imoveis()
    {
        // O 'id' na tabela 'tipoimoveis' é a chave estrangeira 'idtipoimovel' na tabela 'imoveis'
        return $this->hasMany(Imovel::class, 'idtipoimovel', 'id');
    }

}
