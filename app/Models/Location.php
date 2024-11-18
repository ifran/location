<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    // Define a tabela associada
    protected $table = 'location';

    // Define a chave primária
    protected $primaryKey = 'location_id';

    public $timestamps = false; // Desabilita created_at e updated_at


    // Define os campos que podem ser preenchidos
    protected $fillable = [
        'location_name',
        'location_address',
        'location_desc',
        'location_img',
        'user_id',
    ];

    // Define o relacionamento com a tabela 'user'
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
