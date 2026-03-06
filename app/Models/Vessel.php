<?php

namespace App\Models;
use App\Models\VoyageLog;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    
    protected $fillable = [
        'vessel_name',
        'imo_number',
        'call_sign',
    ];
    public function voyageLogs()
    {
        return $this->hasMany(VoyageLog::class);
    }
}


