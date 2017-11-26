@extends('layouts.main')
@section('content')
<section class="section">
	<div class="container">
		<div class="columns is-multiline">
			@foreach($recipes as $recipe)
				<div class="column is-one-quarter">
					<div class="card" data-href="/recipe/{{ $recipe->id }}/{{ $recipe->recipe_slug }}">
						<div class="card-image">
							<figure class="image is-square">
								<img src="/uploads/md/{{ $recipe->media[0]->media_filename }}" alt="Image">
							</figure>
						</div>
						<div class="card-content">
							<div class="media">
								<div class="media-content">
									<p class="title is-4">{{ $recipe->recipe_title }}</p>
									<p>
										<small>
										<a href="/user/{{ $recipe->owner->id }}/recipes">
											{{ $recipe->owner->display_name }}
										</a>| {{ $recipe->created_at->diffForHumans() }}
									</small>

									</p>
								</div>
							</div>
						</div>
					</div>					
				</div>
			@endforeach
		</div>
	</div>
</section>
@stop