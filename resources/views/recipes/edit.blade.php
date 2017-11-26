@extends('layouts.main')

@section('content')
<section class="section">
	<div class="container">
		<div class="content">
			<h1 class="title">Edit Recipe: {{ $recipe->recipe_title }}</h1>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<form name="share" role="form" class="moo edit-recipe" method="post">
			{{ csrf_field() }}

			<div class="field">
				<label for="recipe_title" class="label is-medium">
					Recipe Status
					<span class="label-instruction">Setting the status to inactive will temporarily remove this recipe from all searches.</span>
				</label>
				<div class="control">
					<label class="radio">
						<input type="radio" name="recipe_status" value="1" {{ $recipe->active ? 'checked' : '' }}>
						Active
					</label>
					<label class="radio">
						<input type="radio" name="recipe_status" value="0" {{ !$recipe->active ? 'checked' : '' }}>
						Inactive
					</label>
				</div>
				<br/>
				{{-- <input type="text" name="recipe_title" class="input" value="{{ $recipe->recipe_title }}" /> --}}
			</div>

			<div class="field">
				<label for="recipe_title" class="label is-medium">Recipe Title</label>
				<input type="text" name="recipe_title" class="input" value="{{ $recipe->recipe_title }}" />
			</div>
			<div class="field">
				<label for="recipe_description" class="label is-medium">Recipe Description</label>
				<textarea name="recipe_description" class="textarea">{{ $recipe->recipe_description }}</textarea>
			</div>
			<div class="field">
				<label for="recipe_tags" class="label is-medium">Current Tags</label>
				<div>
				@foreach($recipe->tags as $tag)
					<span class="tag is-medium is-primary">
						{{ $tag->tag_content }}
						<button
							class="delete delete-tag is-small"
							data-tagid="{{ $tag->id }}"
							data-recipeid="{{ $recipe->id }}"
						></button>
					</span>
				@endforeach
				</div>
				<br/>
				<label class="label is-medium">
					Add new Tag(s)
					<span class="label-instruction">Separate each tag with a space. Hyphenate multi-word tags.</span>
				</label>
				<input type="text" name="recipe_tags" class="input" />
			</div>
			<div class="field">
				<label for="recipe_prep_time" class="label is-medium">
					Prep Time
					<span class="label-instruction">In minutes. e.g. 10</span>
				</label>
				<input type="text" class="input" name="recipe_prep_time" value="{{ $recipe->recipe_prep_time }}" />
			</div>
			<div class="field">
				<label for="recipe_cook_time" class="label is-medium">
					Cook Time
					<span class="label-instruction">In minutes. e.g. 10</span>
				</label>
				<input type="text" class="input" name="recipe_cook_time" value="{{ $recipe->recipe_cook_time }}" />
			</div>
			<div class="field">
				<label for="ingredient_name" class="label is-medium">
					Ingredients
					<span class="label-instruction">Place each ingredient on a new line in the order that you would like them to appear. Do not add line numbers</span>
				</label>
				<textarea class="textarea ingredient-textarea" name="ingredient_name">@foreach($recipe->ingredients as $ingredient){{ $ingredient->ingredient_name."\n"}}@endforeach</textarea>
			</div>
			<div class="field">
				<label for="instructions_name" class="label is-medium">
					Instructions
					<span class="label-instruction">Place each instruction on a new line in the order that you would like them to appear. Do not add line numbers</span>
				</label>
				<textarea class="textarea instructions-textarea" name="instructions_name">@foreach($recipe->instructions as $instruction){{ $instruction->instructions_name."\n"}}@endforeach</textarea>
			</div>
			<div class="field">
				<label for="instructions_name" class="label is-medium">Current Image(s)</label>
				<div class="columns is-multiline" id="draggable">
					@foreach($recipe->media as $m)
					<div class="column is-one-quarter">
						<div class="delete delete-image" data-mediafilename="{{ $m->media_filename }}" data-mediarecipeid="{{ $recipe->id }}"></div>
						<img src="/uploads/md/{{ $m->media_filename }}" />

					</div>
					@endforeach
				</div>
				<div class="columns is-multiline" id="droppable">
				</div>
			</div>
			<div class="field">
				<label for="recipe_images" class="label is-medium">
					Add New Image(s)
					<span class="label-instruction">Drag and drop images into the box below or click inside the box to activate a file browser.</span>
				</label>
				<div class="dZone" id="myDropzone">
					<p>Drop files here to upload.</p>
				</div>
			</div>
			<div class="field">
				<label for="recipe_enable_comments" class="label is-medium">
					Allow Comments
					<span class="label-instruction">Choosing "Yes" will allow visitors of the site to leave comments about your recipe.</span>
				</label>
				<div class="control">
					<label class="radio">
						<input type="radio" name="recipe_enable_comments" value="1" {{ $recipe->recipe_enable_comments ? 'checked' : '' }}>
						Yes
					</label>
					<label class="radio">
						<input type="radio" name="recipe_enable_comments" value="0" {{ !$recipe->recipe_enable_comments ? 'checked' : '' }}>
						No
					</label>
				</div>
			</div>
			<div class="field">
				<label for="recipe_additional_information" class="label is-medium">
					Additional Information
					<span class="label-instruction">Add any additional information here.</span>
				</label>
				<textarea class="textarea" name="recipe_additional_information">{{ $recipe->recipe_additional_information }}</textarea>
			</div>
			<div class="field is-grouped">
				<div class="control">
					<button class="button is-primary" name="share">Update Recipe</button>
				</div>
				<div class="control">
					<button class="button is-link">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</section>
@stop