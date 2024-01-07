<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = ['reponse','correct','question_id'];




    function question(){
        return $this->belongsTo(Question::class);
    }
}
