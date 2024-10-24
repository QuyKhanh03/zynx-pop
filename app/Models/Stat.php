<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'funnel_id', 'offer_id', 'impressions', 'clicks', 'cost', 'revenue', 'date'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
