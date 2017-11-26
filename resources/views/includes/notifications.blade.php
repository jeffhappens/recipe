@if(Session::has('error'))
	<div class="notification is-warning has-text-centered">
		<div class="container">
			{{ Session::get('error') }}
		</div>
	</div>
@endif
@if(Session::has('success'))
	<div class="notification is-info has-text-centered">
		<div class="container">
			{{ Session::get('success') }}
		</div>
	</div>
@endif
@if(Session::has('status'))
	<div class="notification is-info has-text-centered">
		<div class="container">
			{{ Session::get('status') }}
		</div>
	</div>
@endif