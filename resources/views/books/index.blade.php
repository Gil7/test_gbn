@extends('layouts.app')


@section('content')
	<h1>Books <i class="fa fa-book"></i></h1>
		<a href="{{url('books/create')}}">
			<i class="fa fa-plus"></i>
			Add book
		</a>
		<table class="table table-striped" id="table-books">
			<thead>
				<tr>
					<th>
						Name
					</th>
					<th>
						Author
					</th>
					<th>
						Categories
					</th>
					<th>
						published at
					</th>
					<th>
						Estatus
					</th>
					<th>
						Options
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($books as $book)
					<tr>
						<td>
							{{$book->name}}
						</td>
						<td>
							{{$book->author}}
						</td>
						<td>
							@foreach ($book->categories as $category)
								<span class="badge">{{$category->name}}</span> <br>
							@endforeach
						</td>
						<td>
							{{$book->published}}
						</td>
						<td>
							@if ($book->available)
								<span class="badge btn btn-success">Available</span>
							@else
								<span class="text-info">Not available: Borrowed - {{$book->current_user->name}}</span>
							@endif
						</td>
						<td>
							<a class="btn btn-xs btn-info" href="{{url("books/$book->id/edit")}}">
								<i class="fa fa-edit"></i>
							</a>
							<a href="" data-id="{{$book->id}}" data-name="{{$book->name}}" class="delete btn btn-xs btn-danger">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
        
    {{ $books->links() }}
	<form action="" method="POST" id="delete_form">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="DELETE">
		
	</form>
@endsection
@section('scripts')
	<script src="{{asset('js/books.js')}}"></script>
@endsection