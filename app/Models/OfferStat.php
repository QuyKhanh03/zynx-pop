<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'impressions',
        'clicks',
        'cost',
        'revenue',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
