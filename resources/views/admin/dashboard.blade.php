@extends('admin.layout')

@section('content')
    <h1>Bashboard</h1>
    <p>Usuario : {{ auth()->user()->name }}</p>
@endsection