@extends('layouts.app')

@section('content')
	<h1>Add Book</h1>
	<form method="POST" action="{{url('books')}}">
		
		
		{!! csrf_field() !!}

		<div class="form-group">
			<label for="">Name:</label>
			<input type="text" name="name" required class="form-control">
		</div>
		<div class="form-group">
			<label for="">Author:</label>
			<input type="text" name="author" required class="form-control">
		</div>
		<div class="form-group">
			<label for="">Categories:</label>
			<select name="categories[]" class="form-control select2" id="" multiple="true">
				@foreach ($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="">Published at:</label>
			<input type="date" name="published" required class="form-control">
		</div>



		<button type="submit" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
		<a href="{{URL::previous()}}" class="btn btn-danger">Cancel <i class="fa fa-times"></i></a>
	<form>

@endsection