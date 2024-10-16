<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'direct_link','partner', 'description', 'status'];

    public function funnels()
    {
        return $this->belongsToMany(Funnel::class, 'funnel_offers')
            ->withPivot('ratio'); // Include the 'ratio' field from the pivot table
    }
}
