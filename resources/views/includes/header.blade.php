<header>
	<div class="container">
		<nav class="navbar">
			<div class="navbar-brand">
				<div class="navbar-burger burger" data-target="navMenubd-example">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>

			<div class="navbar-menu">
				<div class="navbar-end">
					<div class="navbar-item">
						<form id="search">
							<div class="field">
								<div class="control has-icons-left has-icons-right">
									<input class="input" name="query" placeholder="Find a recipe" />
									<span class="icon is-small is-left">
										<i class="fa fa-search"></i>
									</span>									
								</div>
							</div>
						</form>
					</div>

					<div class="navbar-item">
						<a href="/">Home</a>
					</div>

					@if(Auth::check())
						<div class="navbar-item">
							<a href="/user/invite">
								Invite Friend
							</a>
						</div>
						<div class="navbar-item">
							<a href="/recipe/create">Share a Recipe</a>
						</div>

						<div class="navbar-item">
							<a href="/user/{{ Auth::user()->id }}/recipes">My Recipes</a>
						</div>
						<div class="navbar-item">
							<a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								Logout
							</a>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					@else
						<div class="navbar-item">
							<a href="{{ route('login') }}">Login</a>
						</div>
					@endif
				</div>
			</div>
		</nav>
	</div>
</header>
@include('includes.notifications')