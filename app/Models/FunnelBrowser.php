<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelBrowser extends Model
{
    use HasFactory;
    protected $fillable = ['funnel_id', 'browser_id', 'targeting_type'];

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }

    // A funnel browser belongs to a browser
    public function browser()
    {
        return $this->belongsTo(Browser::class);
    }
}
