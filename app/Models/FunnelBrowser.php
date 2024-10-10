<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelBrowser extends Model
{
    use HasFactory;
    protected $fillable = ['funnel_id', 'browser_id', 'targeting_type'];
}
