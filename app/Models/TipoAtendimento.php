<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAtendimento extends Model
{
    use HasFactory;

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class, 'tipo_atendimento_id', 'id');
    }

    protected $table = 'tipos_atendimentos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'status', 
    ];
}
