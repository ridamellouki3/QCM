@extends('layoutUser')


@section('content')
@isset($question)
<form action="{{route('next',['id'=> $question->id ])}}" method="post" class=" m-5 p-5">
    @csrf
    @method('POST')
    <div class="mb-3 row">
        <label for="Question" class="col-form-label h4">Question</label>
   
            <input type="text" class="form-control " id="Question" name="Question" value="{{$question->text}}" readonly>
 
       
    </div>
    @foreach ($question->reponse as $s)
    <div class="mb-3 row">
        <input type="hidden" name="response_ids[]" value="{{$s->id}}">
        <div class="col-4"> 
            <input type="text" class="form-control" readonly value="{{$s->reponse}}"> </div>
        <div class="col-4">
            <input type="checkbox" id="checkbox2" class="form-check-input" name="checkboxe[]">
        </div>
    </div>
    @endforeach
    <div class="mb-3 m-5">
        <button class="btn btn-primary text-center" class="form">submit</button>
    </div>
</form>
    
@endisset

@endsection