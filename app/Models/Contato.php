<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

         /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contato';
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'descricao',
        'idtipocontato',
        'idpessoa'
    ];

    // Relacionamento com imóveis
    public function tipocontato()
    {
        return $this->hasMany(TipoContato::class, 'idtipocontato', 'id');
    }

    public function pessoa()
    
    {
        return $this->belongsTo(Pessoa::class, 'idpessoa', 'id');
    }

}
