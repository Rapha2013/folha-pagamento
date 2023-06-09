<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolhaCalculada extends Model
{
    use HasFactory;

    protected $table = 'folhacalculada';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'mes',
        'ano',
        'horas',
        'valor',
        'bruto',
        'irrf',
        'inss',
        'fgts',
        'liquido',
        'id_funcionario',
        'created_at',
        'updated_at'
    ];

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'id', 'id_funcionario');
    }
}
