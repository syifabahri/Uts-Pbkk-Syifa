<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $guarded = ['id'];


    public function peminjamen()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function pengarangs()
    {
        return $this->belongsToMany(Pengarang::class, 'pengarang_bukus', 'buku_id', 'pengarang_id');
    }
}
