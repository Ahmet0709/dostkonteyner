<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CopKonteyneri extends Model
{
    protected $table = 'cop_konteynerleri'; 

    protected $fillable = ['konteyner_adi']; 

    public function sensorVerileri()
    {
        return $this->hasMany(SensorVerisi::class, 'cop_konteyneri_id');
    }
}
