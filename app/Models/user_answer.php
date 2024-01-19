<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_answer extends Model
{
    use HasFactory;
    protected $table = 'user_answers';
    protected $fillable =['Correct','reponse_id','user_id'];
    function user(){
        return $this->belongsTo(User::class);
    }
    function reponse(){
        return $this->belongsTo(Reponse::class);
    }
}
