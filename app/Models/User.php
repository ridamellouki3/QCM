<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    function role(){
        return $this->belongsTo(Role::class);
    }
    function hasRole($roles){
        return $this->role ==$roles;
    }
    function qcm(){
        return $this->hasMany(Qcm::class);
    }
    function professeur(){
        return $this->belongsToMany(User::class, '_profs__etudiants', 'etudiant_id', 'professeur_id');

    }
     function etudiants()
{
    return $this->belongsToMany(User::class, '_profs__etudiants', 'professeur_id', 'etudiant_id');
}
 function answer(){
    return $this->hasMany(user_answer::class);
}
 function passed(){
    return $this->hasMany(passtest::class);
 }

}
