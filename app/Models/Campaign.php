<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'budget', 'description', 'status', 'delay', 'delay_unit_id', 'frequency', 'frequency_unit_id',];

    public function funnels()
    {
        return $this->hasMany(Funnel::class);
    }

    public function delayUnit()
    {
        return $this->belongsTo(TimeUnit::class, 'delay_unit_id');
    }

    // Relationship with TimeUnit for frequency unit
    public function frequencyUnit()
    {
        return $this->belongsTo(TimeUnit::class, 'frequency_unit_id');
    }
}
