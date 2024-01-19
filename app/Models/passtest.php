<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passtest extends Model
{
    use HasFactory;
    protected $table = '_passtest';
    protected $fillable = ['user_id','qcm_id','Note'];
    function qcm(){
        return $this->belongsTo(Qcm::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
}
