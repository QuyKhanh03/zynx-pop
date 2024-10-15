<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeUnit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation'];


    public function settings()
    {
        return $this->hasMany(FunnelSetting::class);
    }

    // Relationship with Campaigns for delay unit
    public function delayCampaigns()
    {
        return $this->hasMany(Campaign::class, 'delay_unit_id');
    }

    // Relationship with Campaigns for frequency unit
    public function frequencyCampaigns()
    {
        return $this->hasMany(Campaign::class, 'frequency_unit_id');
    }

}
