<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UUIDs
{
    
	 // Generate UUID
    protected static function bootUUIDs()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }


     //Changes the increment attribute of the eloquent database
    public function getIncrementing()
    {
        return false;
    }


     //Changes the key type attribute of the eloquent database

    public function getKeyType()
    {
        return 'string';
    }
}
