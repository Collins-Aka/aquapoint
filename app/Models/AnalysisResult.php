<?php

namespace App\Models;

use App\Traits\UUIDs;
use Illuminate\Database\Eloquent\Model;

class AnalysisResult extends Model
{
    use UUIDs;
    
    protected $fillable = ['water_sample_id', 'turbidity_level', 'contamination_level', 'raw_analysis_data'];
    
    protected $casts = [
        'raw_analysis_data' => 'array',
    ];
    
    public function waterSample()
    {
        return $this->belongsTo(WaterSample::class);
    }
    
    public function treatmentRecommendation()
    {
        return $this->hasOne(TreatmentRecommendation::class);
    }
}
