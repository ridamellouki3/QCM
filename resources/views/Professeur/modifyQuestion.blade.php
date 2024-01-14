@extends('layout')

@section('content')
<form action="{{route('modifyQST',['question'=> $question->id ])}}" method="POST">
@csrf
@method('PUT')
<div class="mb-3">
    <label for="Question" class="form-label">Question </label>
    <input type="text" class="form-control" id="Question" name="Question" value="{{$question->text}}">
</div>
<div class="mb-3">
    <label for="Note">Note</label>
    <input type="number" class="form-control" id="Question" name="Note" value="{{$question->Note}}">
    
</div>

<div class="mb-3">
    <button class="btn btn-primary">submit</button>
</div>
</form>
@endsection