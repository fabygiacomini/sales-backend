<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $casts = [
        'sale_time' => 'datetime:d/m/Y H:i:s'
    ];
}
