<?php

namespace App\Models;

use App\Traits\UUIDs;
use Illuminate\Database\Eloquent\Model;

class WaterSample extends Model
{
    use UUIDs;
    
    protected $fillable = ['user_id', 'image_path', 'metadata', 'location'];
    
    protected $casts = [
        'metadata' => 'array',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function analysisResult()
    {
        return $this->hasOne(AnalysisResult::class);
    }
}
