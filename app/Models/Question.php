<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['text','Note','qcm_id'];



    function qcm(){
        return $this->belongsTo(Qcm::class);
    }
    function reponse(){
        return $this->hasMany(Reponse::class);
    }
}
