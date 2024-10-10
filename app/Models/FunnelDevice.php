<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelDevice extends Model
{
    use HasFactory;

    protected $fillable = ['funnel_id', 'device_id','targeting_type'];
}
