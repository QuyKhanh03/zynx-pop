<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelDevice extends Model
{
    use HasFactory;

    protected $fillable = ['funnel_id', 'device_id','targeting_type'];
    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }

    // A funnel device belongs to a device
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

}
