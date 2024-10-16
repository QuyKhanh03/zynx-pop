<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'status',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'funnel_offers')
            ->withPivot('ratio'); // Include the 'ratio' field from the pivot table
    }

    public function countries()
    {
        return $this->hasMany(FunnelCountry::class);
    }

    public function devices()
    {
        return $this->hasMany(FunnelDevice::class);
    }

    // A funnel has one setting (delay, frequency, etc.)
    public function settings()
    {
        return $this->hasOne(FunnelSetting::class);
    }
}
