@extends('layouts.app')


@section('content')
	<h1>Categories</h1>
		<a href="{{url('categories/create')}}">
			<i class="fa fa-plus"></i>
			Add category
		</a>
		<table class="table table-striped" id="table-categories">
			<thead>
				<tr>
					<th>
						Name
					</th>

					<th>
						Description
					</th>
					<th>
						Options
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $category)
					<tr>
						<td>
							{{$category->name}}
						</td>
						<td>
							{{$category->description}}
						</td>
						<td>
							<a class="btn btn-xs btn-info" href="{{url("categories/$category->id/edit")}}">
								<i class="fa fa-edit"></i>
							</a>
							<a href="" data-id="{{$category->id}}" data-name="{{$category->name}}" class="delete btn btn-xs btn-danger">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
        
    {{ $categories->links() }}
	<form action="" method="POST" id="delete_form">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="DELETE">
		
	</form>
@endsection
@section('scripts')
	<script src="{{asset('js/categories.js')}}"></script>
@endsection