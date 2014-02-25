@extends('layout')

@section('content')
  <h2>My users</h2>
  @foreach($users as $num => $user)
    <div class={{$num}}>
      <span>{{ $user->name }}</span>
      <span>{{ $user->email }}</span>
    </div>
  @endforeach
@stop