<?php

use App\Http\Controllers\Professeur_controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[Professeur_controller::class,'index'])->name('Home');

Route::get('/loginFormAdmin',[Professeur_controller::class,'formLogin'])->name('loginFormAdmin');
Route::post('loginAdmin',[Professeur_controller::class,'login'])->name('loginAdmin');
Route::get('/registreForm',[Professeur_controller::class,'formregistre'])->name('registreFormAdmin');
Route::post('/registreAdmin',[Professeur_controller::class,'registre'])->name('registreAdmin');
Route::get('/lougoutAdmin',[Professeur_controller::class,'logout'])->name('logoutAdmin');
Route::get('/qsmform',[Professeur_controller::class,'qcmform'])->name('qcm');
Route::get('/qcmqstion',[Professeur_controller::class,'question'])->name('formquestion');
Route::post('/qcmqstion/{solnbr}',[Professeur_controller::class,'createaqsm'])->name('createqsm');
Route::get('/Active/{id}',[Professeur_controller::class,'active'])->name('active');
Route::get('/modify/{id}',[Professeur_controller::class,'modify'])->name('modify');
Route::post('/updateQcm/{id}',[Professeur_controller::class,'updateQcm'])->name('updateQcm');
Route::delete('/Delete',[Professeur_controller::class,'Delete'])->name('Delete');
Route::get('/etudiantForm',[Professeur_controller::class,'formEtudiant'])->name("formetud");
Route::post('/addetudiant',[Professeur_controller::class,'addetud'])->name("addetudiant");
Route::post('/deletefromlist',[Professeur_controller::class,'deletefromUsers'])->name("deleteetudfromlist");
Route::post('/addtolist',[Professeur_controller::class,'addtoList'])->name('addetudtolist');
Route::get('/addquestion',[Professeur_controller::class,'addqstForm'])->name('addqstform');
Route::post('/addqst',[Professeur_controller::class,'addqst'])->name('addqst');
Route::post('/Ajouterqst/{solnbr}',[Professeur_controller::class,'Ajouterqst'])->name('Ajouterqst');