<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    // Define a tabela associada
    protected $table = 'user';

    // Define a chave primária
    protected $primaryKey = 'user_id';

    public $timestamps = false; // Desabilita created_at e updated_at


    // Define os campos que podem ser preenchidos
    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_phone',
    ];

    // Define o relacionamento com a tabela 'location'
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class, 'user_id', 'user_id');
    }
}