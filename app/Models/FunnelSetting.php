<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_id',
        'delay',
        'delay_unit_id',
        'frequency',
        'frequency_unit_id',
    ];

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }
}
