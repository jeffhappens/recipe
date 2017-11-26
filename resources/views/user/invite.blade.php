@extends('layouts.main')
@section('content')
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column is-half is-offset-one-quarter">
				<div class="content">
					<h1>Invite a Friend</h1>
					<p>Enter an email address in the form below to invite them to join the community.</p>
				</div>
			</div>
		</div>
		<div class="columns">
			<div class="column is-half is-offset-one-quarter">
				<form method="post">
					{{ csrf_field() }}
					<div class="field">
						<label>E-Mail Address</label>
						<input class="input" type="email" name="inviteEmail" required>
					</div>
					<div class="field">
						<button class="button is-primary">Send Invite</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>
@stop