@extends('layout')

@section('content')
@if(count($qcm)<1)
<h3 class="text text-center">No QCM</h3>
@else
<h3 class="text text-center">Qcm</h3>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Active</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($qcm as $q)
        <tr>
            <th scope="row">{{$q->id}}</th>
            <td>{{$q->Nom}}</td>
            <td class="{{$q->Active==1 ? "text-success":"text-danger"}}"><strong>{{$q->Active==1 ? "TRUE":"FALSE"}}</strong></td>
            <td> 
                <a href="{{route('active',['id' => $q->id ])}}" class="btn {{$q->Active==1 ? "btn-danger":"btn-success"}} mx-1">{{$q->Active==1 ? "Turn off":"Active"}}</a>
                <a href="{{route('modify',['id' => $q->id ])}}" class="btn btn-primary mx-1">Modify</a>
                <a href="#" class="btn btn-light mx-1">Show</a>
                <form method="GET" action="{{route('addqstform')}}" class="d-inline">
                  @csrf
                  @method("GET")
                  <input hidden value="{{$q->id}}" name="id">
                  <button class="btn btn-dark mx-1">Add question</button>

                </form>               
                
                  <form method="POST" action="{{route('Delete')}}" class="d-inline">
                  @csrf
                  @method("DELETE")
                  <input hidden value="{{$q->id}}" name="id">
                  <button class="btn btn-danger mx-1">Delete</button>

                </form>                 
                
            </td>
          </tr>
    
        @endforeach
    </tbody>
</table>
    {{$qcm->links()}}
@endif
@auth
@if(!count($etudiants) < 1 && isset($etudiants) )

<h2 class="text-center">Your students</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($etudiants as $e)
    <tr>
      <th scope="row">{{$e->id}}</th>
      <td>{{$e->name}}</td>
      <td class="text text-dark"><strong>{{$e->email}}</strong></td>
      <td> 
            <form method="POST" action="{{route('deleteetudfromlist')}}" class="d-inline">
            @csrf
            @method("POST")
            <input hidden value="{{$e->id}}" name="id">
            <button class="btn btn-danger mx-1">Delete</button> 

          </form>                 
          
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
    @endif
@endauth
@if(!count($students)<1)
<h2 class="text center">All students </h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      @auth
      <th scope="col">Action</th>
      @endauth
    </tr>
  </thead>
  <tbody>
    @foreach ($students as $s)
    <tr>
      <th scope="row">{{$s->id}}</th>
      <td>{{$s->name}}</td>
      <td class="text text-dark"><strong>{{$s->email}}</strong></td>
      @auth
      <td> 
            <form method="POST" action="{{route('addetudtolist')}}" class="d-inline">
            @csrf
            @method("POST")
            <input hidden value="{{$s->id}}" name="id">
            <button class="btn btn-primary mx-1">Add to your list</button> 

          </form>                 
          
      </td>
      @endauth
    </tr>
    @endforeach
  </tbody>
@else
<h2>No students</h2>
@endif
@endsection