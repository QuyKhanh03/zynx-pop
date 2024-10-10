<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelCountry extends Model
{
    use HasFactory;
    protected $fillable = ['funnel_id', 'country_id', 'targeting_type'];
}
