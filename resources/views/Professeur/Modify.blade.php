@extends('layout')


@section('content')
<form action="{{route('updateQcm',['id'=> $qcm->id])}}" method="POST">
@csrf
@method('POST')
<div class="mb-3">
    <label for="QCM" class="form-label">Nom du QSM</label>
    <input type="text" class="form-control" id="QCM" name="QCM" value="{{$qcm->Nom}}">
</div>
<div class="mb-3">
    <button class="btn btn-primary" class="form">submit</button>
</div>
</form>
    
@endsection