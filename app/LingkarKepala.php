<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LingkarKepala extends Model
{
    protected $table = 'lingkar_kepala';

    protected $fillable = [
        'umur',
        'min3sd',
        'min2sd',
        'min1sd',
        'median',
        'plus1sd',
        'plus2sd',
        'plus3sd',
    ];
}
