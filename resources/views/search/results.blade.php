@extends('layouts.main')

@section('content')
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column">
				<div class="content">
					<h1>Search results for "{{ $query }}"</h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		@foreach($recipes as $recipe)
			<div class="columns" style="background: #f8f8f8;margin-bottom:35px">
				<div class="column is-one-quarter">
					<img src="/uploads/md/{{ $recipe->media_filename }}" />
				</div>
				<div class="column is-three-quarters">
					<div class="content">
						<h2><a href="/recipe/{{ $recipe->id }}/{{ $recipe->recipe_slug }}">{{ $recipe->recipe_title }}</a></h2>
						<p>
							<a href="/user/{{ $recipe->userid }}/recipes">{{ $recipe->display_name }}</a>
							|
							{{ $recipe->created_at->diffForHumans() }}</p>
						<p>{{ str_limit($recipe->recipe_description, 200) }}</p>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</section>
@stop