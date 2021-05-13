<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoAtendimento::class, 'tipo_atendimento_id');
    }

    protected $table = 'atendimentos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data_da_execucao', 
        'cliente',
        'observacao',
        'user_id',
        'tipo_atendimento_id', 
    ];
}
