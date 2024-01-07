<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qcm extends Model
{
    use HasFactory;


    protected $fillable = ['Nom','user_id'];


   function user(){
    return $this->belongsTo(User::class);
   }
   function question(){
    return $this->hasMany(Question::class);
   }
}
