<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['code','name', 'budget','content', 'description', 'status', 'delay', 'delay_unit', 'number_of_popups', 'every', 'every_unit', 'pop_interval','interval_unit', 'website_id'];

    public function funnels()
    {
        return $this->hasMany(Funnel::class);
    }
    public static function generateCode()
    {
        do {
            $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('code', $code)->exists());

        return $code;
    }

    public function stats()
    {
        return $this->hasMany(CampaignStat::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
