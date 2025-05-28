<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;

    protected $table = 'pengarangs';

    protected $guarded = ['id'];

    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'pengarang_bukus', 'pengarang_id', 'buku_id');
    }
}
