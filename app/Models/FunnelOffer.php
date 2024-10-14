<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_id',
        'offer_id',
        'ratio',
    ];
}
