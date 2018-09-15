@extends('layouts.app')
@section('content')
	<h1>Users</h1>
		<a href="{{url('users/create')}}">
			<i class="fa fa-plus"></i>
			Add user
		</a>
		<table class="table table-striped" id="table-users">
			<thead>
				<tr>
					<th>
						Name
					</th>

					<th>
						Email
					</th>
					<th>
						Options
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td>
							{{$user->name}}
						</td>
						<td>
							{{$user->email}}
						</td>
						<td>
							<a class="btn btn-xs btn-info" href="{{url("users/$user->id/edit")}}">
								<i class="fa fa-edit"></i>
							</a>
							<a href="" data-id="{{$user->id}}" data-name="{{$user->name}}" class="delete btn btn-xs btn-danger">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
        
    {{ $users->links() }}
	<form action="" method="POST" id="delete_form">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="DELETE">
		
	</form>
@endsection
@section('scripts')
	<script src="{{asset('js/users.js')}}"></script>
@endsection