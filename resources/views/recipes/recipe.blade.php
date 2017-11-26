@extends('layouts.main')

@section('content')
<div class="recipe-hero-image" style="background:url(/uploads/lg/{{ $recipe->media[0]->media_filename }}) no-repeat center center fixed;background-size:cover">
	<div class="container">
		<ul class="recipe-thumbnail-list">
			@foreach($recipe->media as $m)
			<li><img src="/uploads/xs/{{ $m->media_filename }}" /></li>
			@endforeach
		</ul>
	</div>
</div>

<section class="section">
	<div class="container">
		<div class="content">
			<div class="level" style="margin-bottom:0">
				<div class="level-left">
					<h1>{{ $recipe->recipe_title }}</h1>
				</div>
				<div class="level-right">
					<p><a class="button is-light kitchen-view" href="">Kitchen View</a><p>
				</div>
			</div>
			<p>
				{{ $recipe->owner->display_name }}
				|
				{{ $recipe->created_at->diffForHumans() }}
			</p>
			<p>Prep time: {{ $recipe->recipe_prep_time }} Cook time: {{ $recipe->recipe_cook_time }}</p>
			<p><small>Tags:</small>
				@foreach($recipe->tags as $tag)
					<a href="/search/{{ $tag->tag_content }}">
						<span class="tag">{{ $tag->tag_content }}</span>
					</a>
				@endforeach
			</p>			
			<p>{{ $recipe->recipe_description }}</p>
		</div>
	</div>
</section>
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column is-one-third">
				<div class="content">
					<h3>Ingredients</h3>
					@if(count($recipe->ingredients) > 0)
						<ul>
						@foreach($recipe->ingredients as $ingredient)
						<li>{{ $ingredient->ingredient_name }}</li>
						@endforeach
						</ul>
					@endif					
				</div>
			</div>
			<div class="column is-two-thirds">
				<div class="content">
					<h3>Instructions</h3>
					@if(count($recipe->instructions) > 0)
						<ol>
						@foreach($recipe->instructions as $instruction)
						<li>{{ $instruction->instructions_name }}</li>
						@endforeach
						</ol>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>

@if($recipe->recipe_additional_information)
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column">
				<div class="content">
					<h3>Additional Information</h3>
					{!! $recipe->recipe_additional_information !!}
				</div>
			</div>
		</div>
	</div>
</section>	
@endif

@if($recipe->recipe_enable_comments)
<section class="section">
	<div class="container" style="margin-top:25px">
		<div id="disqus_thread"></div>
		<script>
		/**
		*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
		*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
		/*
		var disqus_config = function () {
		this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
		this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
		};
		*/
		(function() { // DON'T EDIT BELOW THIS LINE
			var d = document, s = d.createElement('script');
			s.src = 'https://newrecipeengine.disqus.com/embed.js';
			s.setAttribute('data-timestamp', +new Date());
			(d.head || d.body).appendChild(s);
		})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	</div>
</section>
@endif
@stop