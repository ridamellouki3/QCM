<?php

namespace App\Http\Controllers;

use App\Models\passtest;
use App\Models\Qcm;
use App\Models\Question;
use App\Models\Reponse;
use App\Models\Role;
use App\Models\User;
use App\Models\user_answer;
use Illuminate\Support\Facades\Session ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    //
    function index(){
        if(Auth::check()){
            $User=Auth::user();
            
            $Prof = $User->professeur;
            
            return view('etudiant.Home',compact('Prof'));
        }
        return view('etudiant.Home');
    }
    function loginForm(){
        return view('etudiant.login');
    }
    function login(Request $request){
        $validate = $request->validate([
            'Email' => 'required|email',
            'Password' =>'required|min:6'
        ]);
        $input= [
            'email'=>$request->Email,
            'password'=>$request->Password,
            'role_id' => Role::where('role','etudiant')->first()->id 
        ];
        
        if(Auth::attempt($input)){
            $request->session()->regenerate();
            return redirect()->route('HomeUser')->with('success','Welcome');
        }
        return redirect()->route('LoginForm')->with('Error','something went wrong');
    }
    function logout(){
        Auth::logout();
        Session::regenerateToken();
        return redirect()->route('HomeUser')->with('success', 'You have been logged out successfully.');
    }
    function startQuiz(int $Qcm){
        $Qcm = Qcm::where('id',$Qcm)->first(); 
        $question = $Qcm->question()->first();
        $input = [
            'qcm_id'=>$Qcm->id,
            'user_id'=>Auth::id(),
            'Note'=>0
        ];
        passtest::create($input);
        
        return view('etudiant.Take_test',compact('question'));
    }
     function showscores(int $Qcm){
        $score = 0;
        $qcm = Qcm::where('id',$Qcm)->first();
        foreach( $qcm->question()->get() as $question){
            $i=1;
            foreach($question->reponse()->get() as $rep){
            $answer = user_answer::where(['reponse_id'=> $rep->id ,'user_id'=>Auth::id()])->first();
            
            if($rep->correct != $answer->Correct){
                $i=0;
            }
            }
            if($i!=0){
                $score+=$question->Note ; 
            }

        }
        $Pastest = passtest::where(['user_id'=>Auth::id(),'qcm_id'=>$qcm->id])->first();
        $Pastest->Note = $score;
        $Pastest->update();
        return redirect()->route('HomeUser')->with('success', 'You are passed the test successfully.');
    }
    function showQuestion(Request $request ,int $question_id){
        $Qcm = Question::where('id', $question_id )->first()->qcm()->first();
       
        $validated = $request->validate([
            'checkboxe.*'=>'required'
        ]);
        for($i=0;$i<count($request->response_ids);$i++){
            $input =[
                'user_id'=>Auth::id(),
                'reponse_id'=>$request->response_ids[$i]
            ];
            if(isset($request->checkboxe[$i])){
                $input['Correct']=1;
            }
            user_answer::create($input); 
        }    
        $question = Question::where('id' ,'>', $question_id )->first();
        if(!$question){
            EtudiantController::showscores($Qcm->id);
            return redirect()->route('HomeUser')->with('success', 'You Passed THE TEST successfully.');
        }
        else{
            return redirect()->route('Shownext',['id'=>$question]);
        }
    }
   
}
