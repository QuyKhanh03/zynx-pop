<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'budget', 'description', 'status', 'delay', 'delay_unit_id', 'frequency', 'frequency_unit_id',];
}
