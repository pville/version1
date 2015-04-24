@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Volunteer Home</div>

				<div class="panel-body">
					Welcome {{ $user->email }} <br>
					@if($user->IsMember())
						You are a member of {{ $user->group->name }}
					@endif 
				</div>
						
						
			</div>
		</div>
	</div>
</div>
@endsection