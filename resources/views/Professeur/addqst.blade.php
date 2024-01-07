@extends('layout')

@section('content')
@if(isset($Question))
<form action="{{route('Ajouterqst',[ 'solnbr' =>$Question['nbr_sol'] ])}}" method="post">
    @csrf
    @method('POST')
    <div class="mb-3">
        <label for="QCM" class="form-label">Nom du QSM</label>
        <input type="text" class="form-control" id="QCM" name="QCM" value="{{$Question['Qcm']}}" readonly>
    </div>
    <input type="number" name="QCM_id" value="{{$Question['Qcm_id']}}" hidden>
    <div class="mb-3">
        <label for="text" class="form-label">Question</label>
        <input type="text" class="form-control" id="Question" name="Question" value="{{$Question['Question']}}">
    </div>
    @for ($i = 0; $i < $Question['nbr_sol']; $i++)
    <div class="mb-3">
        <label for="text" class="form-label">Solution {{$i+1}}</label>
        <input type="text" class="form-control" id="Question" name="sol[{{$i}}]">
    </div>
    <div class="mb-3">
        <input type="radio" id="checkbox2" name="checkboxe[{{$i}}]">
        <label for="checkbox2" class="form-label" value="true">True</label>

    </div>
    @endfor
    <div class="mb-3">
        <label for="Note" class="form-label">Note</label>
        <input type="text" class="form-control" id="Note" name="Note">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" class="form">submit</button>
    </div>
</form>
@else
<form action="{{route('addqst')}}" method="post">
    @csrf
    @method('POST')
    <div class="mb-3">
        <label for="QCM" class="form-label">Nom du QSM</label>
        <input type="text" class="form-control" id="QCM" name="QCM" value="{{$qcm->Nom}}" readonly>
    </div>
    <input type="number" class="form-control" id="QCM_id" name="QCM_id" value="{{$qcm->id}}" hidden >
    <div class="mb-3">
        <label for="Question" class="form-label">Question</label>
        <input type="text" class="form-control" id="Question" name="Question" required>
    </div>
    <div class="mb-3">
        <label for="nbr_sol" class="form-label">Solution Number</label>
        <input type="number" class="form-control" id="nbr_sol" name="nbr_sol">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" class="form">submit</button>
    </div>
</form>
@endif
@endsection