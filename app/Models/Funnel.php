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
        return $this->hasMany(FunnelOffer::class);
    }

    public function browsers()
    {
        return $this->hasMany(FunnelBrowser::class); // Adjust this based on your model structure
    }

    public function countries()
    {
        return $this->hasMany(FunnelCountry::class); // Adjust this based on your model structure
    }

    public function devices()
    {
        return $this->hasMany(FunnelDevice::class); // Adjust this based on your model structure
    }

    // A funnel has one setting (delay, frequency, etc.)
    public function settings()
    {
        return $this->hasOne(FunnelSetting::class);
    }
}
