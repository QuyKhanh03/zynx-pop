<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelCountry extends Model
{
    use HasFactory;
    protected $fillable = ['funnel_id', 'country_id', 'targeting_type'];

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }

    // A funnel country belongs to a country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
