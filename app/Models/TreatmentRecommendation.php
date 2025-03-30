<?php

namespace App\Models;

use App\Traits\UUIDs;
use Illuminate\Database\Eloquent\Model;

class TreatmentRecommendation extends Model
{
    use UUIDs;
    
    protected $fillable = ['analysis_result_id', 'recommended_treatment', 'educational_content'];
    
    public function analysisResult()
    {
        return $this->belongsTo(AnalysisResult::class);
    }
}
