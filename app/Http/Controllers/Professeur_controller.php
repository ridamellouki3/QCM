<?php

namespace App\Http\Controllers;

use App\Models\Qcm;
use App\Models\Question;
use App\Models\Reponse;
use App\Models\Role;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session ;

class Professeur_controller extends Controller
{
     function index(){
        $qcm = Qcm::where('user_id',Auth::id())->paginate(5);
        $etudiants="" ;
        if(Auth::check()){
            $prof = Auth::user();
        $etudiants = $prof->etudiants;
        }
        
        $role = Role::where('role','Etudiant')->first();
        $students = User::where('role_id',$role->id)->get();
       
        return view('Professeur.Home',compact('qcm','etudiants','students'));
    }
     function formLogin(){
        return view('Professeur.Login');
    }
     function formregistre(){
        return view('Professeur.registre');
    }

     function registre(Request $req){
        $validated = $req->validate([
            'name' => 'required|min:3',
            'Email'=>'required|email',
            'Password'=>'required|confirmed|min:6'
        ]);
        $role = Role::where('role','professeur')->first();
        
        $input = [
            'name' => $req->name,
            'email'=>$req->Email,
            'password'=>Hash::make($req->Password),
            'role_id' => $role->id
        ];
       User::create($input);

        return redirect()->route('Home')->with('success','Hello You can know log in');
     }

     //Login
     function login(Request $request){
        $validated = $request->validate([
            'Email' => 'required|email',
            'Password' =>'required|min:6'
        ]);
        $input= [
            'email'=>$request->Email,
            'password'=>$request->Password,
            'role_id' => Role::where('role','Professeur')->first()->id 
        ];
        
        if(Auth::attempt($input)){
            $request->session()->regenerate();
            return redirect()->route('Home')->with('success','Welcome');
        }
        return redirect()->route('loginFormAdmin')->with('Error','something went wrong');
     }
     function logout(){
        Auth::logout();
        Session::regenerateToken();
        return redirect()->route('Home')->with('success', 'You have been logged out successfully.');

     }

     function qcmform(){
        return view('Professeur.Qcm');
     }
     function question(Request $req){
        $validated = $req->validate([
            'QCM'=>'required',
            'Question'=>'required|min:10',
            'nbr_sol' =>'required|Integer'
        ]);
        $Question =[
            'QCM'=>$req->QCM,
           'question' => $req->Question,
            'nbr_sol' => $req->nbr_sol 
        ];
        
        return view('Professeur.Qcm',compact('Question'));

     }
     function createaqsm(Request $request,int $solnbr){
        $validated= $request->validate([
            'QCM'=>'required',
            'Question'=>'required|min:10',
            'checkboxe.*'=>'required',
            'sol.*'=>'required'
        ]);
        $input =[
            'Nom'=>$request->QCM,
            'user_id'=>Auth::id()
        ];
        $qcm =Qcm::create($input);
        $input =[
            'text' =>$request->Question,
            'Note' =>$request->Note,
            'qcm_id'=>$qcm->id
        ];
        $qst=Question::create($input);
        for($i=0;$i<$solnbr;$i++){
            $correct= false ;
            if(isset($request->checkboxe[$i])){
                $correct=true ; 
            }
            $input = [
                'reponse'=>$request->sol[$i],
                'correct'=>$correct,
                'question_id'=>$qst->id
            ];
            Reponse::create($input);
           
        }
        return redirect()->route('Home')->with('success','Qcm are created successfully');
     }
     public function boot(): void
{
    Paginator::useBootstrapFive();
    Paginator::useBootstrapFour();
}
    public function active(int $id){
        $qcm = Qcm::where('id',$id)->first();
    if($qcm->Active == 0){
        $qcm->Active =1;
        $qcm->update();
        return redirect()->route('Home')->with('success','Qcm now is active');
    }
    $qcm->Active =0;
    $qcm->update();
    return redirect()->route('Home')->with('success','Qcm are Not ACTIVE');

    }

    function modify(int $id){
    $qcm = Qcm::where('id',$id)->first();

    return view('Professeur.Modify',compact('qcm'));    
    }
    function updateQcm(Request $req,int $id){
        $validated= $req->validate([
            'QCM'=>'required'
        ]);
        $qcm = Qcm::where('id',$id)->first();
        $qcm->Nom = $req->QCM;
        $qcm->update();
        return redirect()->route('modify',['id'=>$id])->with('success','Name of the QCM are updated');
        

    }
    function Delete(Request $req){
        $qcm = Qcm::where('id',$req->id);
        $qcm->delete();
        return redirect()->route('Home')->with('success','Qcm deleted');
    }
    function formEtudiant(){
        return view('Professeur.FormEtudiant');
    }
    function addetud(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3',
            'Email'=>'required|email',
            'Password'=>'required|confirmed|min:6'
        ]);
        $role = Role::where('role','Etudiant')->first();
        $input = [
            'name' => $request->name,
            'email'=>$request->Email,
            'password'=>Hash::make($request->Password),
            'role_id' => $role->id,
            'professeur_id'=>Auth::id()
        ];
       $etudiant = User::create($input);
       $etudiant->professeur()->attach(Auth::user()->id);
       
    

        return redirect()->route('Home')->with('success','Etudiant ajouted successfully');
    }
    function deletefromUsers(Request $req){

        $prof = Auth::user();
        $etud = User::where('id',$req->id)->first();
        $etud->professeur()->detach($prof->id);
        return redirect()->route('Home')->with('success','Etudiant deleted from your List');
    }
    function addtoList(Request $request){
        $prof = Auth::user();
        $etud = User::where('id',$request->id)->first();
        $etud->professeur()->attach($prof->id);
    return redirect()->route('Home')->with('success','Etudiant ajouted to your list');

    }
    function addqstForm(Request $req){
        $qcm = Qcm::where('id',$req->id)->first();
        return view('Professeur.addqst',compact('qcm'));

    }
    function addqst(Request $req){
        $validated = $req->validate([
            'QCM'=>'required',
            'Question'=>'required',
            'nbr_sol' => 'required'
        ]);
        $Question = [
            'Qcm'=>$req->QCM,
            'Question'=>$req->Question,
            'Qcm_id'=>$req->QCM_id,
            'nbr_sol'=>$req->nbr_sol
        ];
        return view('Professeur.addqst',compact('Question'));
    }
    function Ajouterqst(Request $request,int $solnbr){
        $validated= $request->validate([
            'QCM'=>'required',
            'Question'=>'required|min:10',
            'checkboxe.*'=>'required',
            'sol.*'=>'required'
        ]);

        $qcm =Qcm::where('id',$request->QCM_id)->first();
        $input =[
            'text' =>$request->Question,
            'Note' =>$request->Note,
            'qcm_id'=>$qcm->id
        ];
        $qst=Question::create($input);
        for($i=0;$i<$solnbr;$i++){
            $correct= false ;
            if(isset($request->checkboxe[$i])){
                $correct=true ; 
            }
            $input = [
                'reponse'=>$request->sol[$i],
                'correct'=>$correct,
                'question_id'=>$qst->id
            ];
            Reponse::create($input);
           
        }
        return redirect()->route('Home')->with('success','Question ajouted successfully');

    }
    function show(Qcm $id){
        $qcm = $id;
        if(count($qcm->question()->get() ) >0){
            return view('Professeur.showQCM',compact('qcm'));
        }
        else{
            return redirect()->back()->with('Error','Nothing to show you should add some Questions');
        }
       
    }
    function deleteqst(Question $question){
    $question->delete();
    return redirect()->back()->with('success','Question deleted successfully');
    }
    function modifyform(Question $question){
        return view('Professeur.modifyQuestion',compact('question'));
    } 
    function modifyQST(Request $request,Question $question){
        $validated = $request->validate([
            'Question'=>'required',
            'Note'=>'required|Integer'
        ]);
        $input = [
            'text'=>$request->Question,
            'Note'=>$request->Note
        ];
        $question->update($input);
        return redirect()->route('Home')->with('success','Question UPDATED successfully');
    }
    function deleteresponse(Reponse $reponse){
        $reponse->delete();
        return redirect()->back()->with('success','reponse deleted successfully');
    }
    function modifyforme(Reponse $reponse){

        return view('Professeur.modifyResponse',compact('reponse'));
    }
    function modifyReponse(Request $request,Reponse $reponse){
        $validated = $request->validate([
            'reponse'=>'required'
        ]);
        $input=[
            'reponse'=>$request->reponse
        ];

        if($request->has('correct')){
            $input['correct'] = 1 ;
        }else{
            $input['correct'] = 0 ;
        }
        $reponse->update($input);
        return redirect()->route('Home')->with('success','Reponse UPDATED successfully');
    }
}
