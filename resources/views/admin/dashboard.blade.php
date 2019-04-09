@extends('admin.layout')

@section('header')
<h1>
    Page Header
    <small>Optional description</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('content')
    <h1>Bashboard</h1>
    <p>Usuario : {{ auth()->user()->name }}</p>
@endsection