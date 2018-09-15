@extends('layouts.app')


@section('content')
	<h1>Modify category</h1>
	<form method="POST" action="{{url("categories/$category->id")}}">
		
		
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<div class="form-group">
			<label for="">Name:</label>
			<input type="text" name="name" value="{{$category->name}}" required class="form-control">
		</div>
		<div class="form-group">
			<label for="">Description:</label>
			<input type="text" value="{{$category->description}}" name="description" required class="form-control">
		</div>
		<button type="submit" class="btn btn-primary">Save <i class="fa fa-check"></i></button>
		<a href="{{url('categories')}}" class="btn btn-danger">Cancel <i class="fa fa-times"></i></a>
	<form>

@endsection