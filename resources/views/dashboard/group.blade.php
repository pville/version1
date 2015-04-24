@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Group Home</div>

				<div class="panel-body">
					Welcome {{ $user->group->name }} <br>
						 
						 @foreach($user->group->getGroupMembers() as $member)
								      <span>{{ $member->email }}</span><br>
						 @endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection