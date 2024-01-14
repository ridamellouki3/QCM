@extends('layout')

@section('content')

<form action="{{route('modifyReponse',['reponse'=> $reponse->id ])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="reponse" class="form-label">reponse </label>
        <input type="text" class="form-control" id="reponse" name="reponse" value="{{$reponse->reponse}}">
    </div>
    <div class="mb-3">
        <label for="correct">True</label>
        <input type="checkbox" class="form-check-input" id="correct" value="1" name="correct" {{($reponse->correct==1)?"checked":""}}>
        
    </div>
    
    <div class="mb-3">
        <button class="btn btn-primary">submit</button>
    </div>
    </form>
@endsection