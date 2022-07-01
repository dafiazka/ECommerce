<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_users', 'id');
    }

    public function kirim()
    {
        return $this->belongsTo('App\Models\Kirim', 'id_kirims', 'id');
    }

    public function metode()
    {
        return $this->belongsTo('App\Models\Metode', 'id_metodes', 'id');
    }

}
