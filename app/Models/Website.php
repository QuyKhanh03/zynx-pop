<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'status'];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

}
