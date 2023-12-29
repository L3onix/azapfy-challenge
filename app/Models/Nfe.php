<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfe extends Model
{
    use HasFactory;

    protected $table = "nfes";
    protected $primaryKey = "nfe_id";
    protected $fillable = [
        'numero',
        'valor',
        'data_emissao',
        'nome_remetente',
        'cnpj_transportador',
        'nome_transportador',
    ];

    /**
     * Get the user that owns the Nfe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
