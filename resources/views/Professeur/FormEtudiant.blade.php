@extends('layout')

@section('content')
<form action="{{route('addetudiant')}}" method="post" class="container m-5 p-5">
    @csrf
    @method('POST')
    <div class="mb-3">
        <label for="name" class="form-label">Nom </label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="Email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="Email" name="Email" placeholder="name123@gmail.com">
    </div>
    <div class="mb-3">
        <label for="Password" class="form-label">Motpasse</label>
        <input type="password" class="form-control" id="Password" name="Password">

    </div>
    <div class="mb-3">
        <label for="Password_Confirme" class="form-label"> Confirm Motpasse</label>
        <input type="password" class="form-control" id="Password_Confirme" name="Password_confirmation">

    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" name="submit" value="Registre">
    </div>
</form>  
@endsection