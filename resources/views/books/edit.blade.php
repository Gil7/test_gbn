@extends('layouts.app')
@section('content')
	<h1>Modify Book</h1>
	<form method="POST" action="{{url("books/$book->id")}}">
		
		
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<div class="form-group">
			<label for="">Name:</label>
			<input type="text" name="name" value="{{$book->name}}" required class="form-control">
		</div>
		<div class="form-group">
			<label for="">Description:</label>
			<input type="text" value="{{$book->author}}" name="author" required class="form-control">
		</div>
		<div class="form-group">
			<label for="">Categories:</label>
			<select name="categories[]" class="form-control select2" id="" multiple="multiple">
				@foreach ($categories as $category)
					<option @if (in_array($category->id, $categories_id))
						selected="" 
					@endif value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="">Published at:</label>
			<input type="date" name="published" value="{{$book->published}}" required class="form-control">
		</div>
		<div class="form-group">
			<label for="">Available:</label>
			<select name="available" class="form-control" id="" >
				<option @if ($book->available == 1)
					selected
				@endif value="1">Si</option>
				<option @if ($book->available == 0)
					selected
				@endif value="0">No</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Save <i class="fa fa-check"></i></button>
		<a href="{{url('books')}}" class="btn btn-danger">Cancel <i class="fa fa-times"></i></a>
	<form>

@endsection