@extends('layoutUser')


@section('content')
@isset($Prof)
@foreach ($Prof as $P)
    <h4 class="text text-center">Qcms by :<strong>{{$P->name}}</strong></h4>
    @foreach ($P->qcm as $Qcm)
    
    @if ($Qcm->Active==1)
    @if($Qcm->passe()->where('user_id',Auth::id())->first()  )
    <div class="card mb-3" >
      <div class="card-body p-5 row">
        <h3 class="card-title text-center col-4">{{$Qcm->Nom}}</h3>
        <h4 class="text text-success col-4">Test passed</h4>
        <h4 class="text-success col-4">Your results is : <strong>{{$Qcm->passe()->where(['user_id'=>Auth::id(),'qcm_id'=>$Qcm->id])->first()->Note}}</strong></h4>
      </div>
    </div>
    @else
    <div class="card mb-3" >
      <div class="card-body p-5 row">
        <h3 class="card-title text-center col-4">{{$Qcm->Nom}}</h3>
        <h4 class="text col-4"></h4>
        <a href="{{route('startQuiz',['Qcm' => $Qcm->id ] )}}" class="btn btn-primary col-4">Take the test</a>
      </div>
    </div>

    @endif
    @endif 
    @endforeach   
@endforeach    
@endisset


@endsection