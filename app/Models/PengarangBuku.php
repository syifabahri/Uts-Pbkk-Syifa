<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengarangBuku extends Model
{
    use HasFactory;

    protected $table = 'pengarang_bukus';

    protected $guarded = ['id'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class);
    }
}
