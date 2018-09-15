@extends('layouts.app')


@section('content')
	<h1>Add category</h1>
	<form method="POST" action="{{url('categories')}}">
		
		
		{!! csrf_field() !!}

		<div class="form-group">
			<label for="">Name:</label>
			<input type="text" name="name" required class="form-control">
		</div>
		<div class="form-group">
			<label for="">Description:</label>
			<input type="text" name="description" required class="form-control">
		</div>
		<button type="submit" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
		<a href="{{URL::previous()}}" class="btn btn-danger">Cancel <i class="fa fa-times"></i></a>
	<form>

@endsection