@extends('layout')


@section('content')
    <h1 class="text-center">{{$qcm->Nom}}</h1>
    {{-- <h5 class="text-center" ><strong>{{ $qcm->user()->first()->name }}</strong></h5> --}}
@foreach($qcm->question()->get() as $question)
<div class="border p-3 mb-3">
    <div class="row">
        <h3 class="text-center m-2">Question {{$loop->iteration }} </h3>
        
        
            <div class="col-4">
                
                <h5 >{{ $question->text }}</h5>
            </div>
            <div class="col-4 ">
                <h5>Note : {{$question->Note}}</h5>
            </div>
                <div class="col-4">
                    <a href="{{route('deleteqst',[ 'question' => $question->id ])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    <a href="{{route('modifyform',['question'=> $question->id ])}}" class="btn btn-primary"><i class="fas fa-pencil-square fa-lg"></i></a>
                </div>
        
        </div>
        <h4 class="text-center text-success m-4">Response {{$loop->iteration }}</h4>
        @foreach($question->reponse()->get() as $reponse )
        <div class="row mb-3">
            <div class="col-4">
                <label for="checkbox" ><strong>{{ $reponse->reponse }}</strong></label>
            </div>
                <div class="col-4">
                <input type="checkbox" id="checkbox" class="form-check-input"   {{ ($reponse->correct==1)?"checked":"" }} disabled >
            </div>
            <div class="col-4">
                <a href="{{route('deleteresponse',[ 'reponse' => $reponse->id ])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                <a href="{{route('modifyforme',['reponse'=> $reponse->id ])}}" class="btn btn-primary"><i class="fas fa-pencil-square fa-lg"></i></a>
            </div>
        </div>
        
        
        @endforeach    
</div>



@endforeach



@endsection