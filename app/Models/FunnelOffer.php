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
    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }

    // A funnel offer belongs to an offer
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

}
