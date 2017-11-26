@extends('layouts.main')
@section('content')
<section class="section">
	<div class="container">
		<div class="content">
			<h1 class="title">{{ str_possessive($recipeAuthor->display_name) }} Recipes</h1>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		@foreach($recipes as $recipe)
			<div class="columns" style="margin-bottom:25px;">
				<div class="column is-one-quarter">
					<img src="/uploads/md/{{ $recipe->media[0]->media_filename }}" {{ !$recipe->active ? 'style=opacity:.5' : '' }} />
				</div>
				<div class="column is-three-quarters">
					<div class="content">
						<h3>
							<a href="/recipe/{{ $recipe->id }}/{{ $recipe->recipe_slug }}">{{ $recipe->recipe_title}}</a>
						</h3>
						<p>{{ $recipe->recipe_description }}</p>
						<p>
							<a href="/recipe/{{ $recipe->id }}/{{ $recipe->recipe_slug }}" class="button is-small">View Recipe</a>
							@if($canEdit)
								<a href="/recipe/{{ $recipe->id }}/edit" class="button is-small">Edit Recipe</a>
							@endif
						</p>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</section>
@stop