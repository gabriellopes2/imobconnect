<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImovelImagem extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'imovelimagem';
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'idimovel',
        'imagem',
        'descricao',
        'idlocalimagem'
    ];

    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'idimovel', 'id');
    }

    public function localimagem()
    {
        return $this->belongsTo(LocalImagem::class, 'idlocalimagem', 'id');
    }
}
