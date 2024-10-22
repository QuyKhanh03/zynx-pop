<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignStat extends Model
{
    use HasFactory;
    protected $fillable = [
        'campaign_id',
        'impressions',
        'clicks',
        'cost',
        'revenue',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
