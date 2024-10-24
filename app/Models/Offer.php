<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'direct_link','partner', 'description', 'status','cost'];

    public function funnels()
    {
        return $this->hasMany(FunnelOffer::class);
    }

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }

}
