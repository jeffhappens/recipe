@extends('layouts.main')


@section('content')

	<section class="section">
		<div class="container">
			<div class="content">
				<h1>Share a Recipe</h1>
				<p>Use the form below to share your recipe with the rest of the community.</p>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">

			<form name="share" role="form" class="moo create-recipe" method="post">
				{{ csrf_field() }}

				<div class="field">
					<label for="recipe_title" class="label is-medium">Recipe Title</label>
					<input type="text" name="recipe_title" class="input" required/>
				</div>

				<div class="field">
					<label for="recipe_description" class="label is-medium">
						Recipe Description
					</label>
					<textarea name="recipe_description" class="textarea" required></textarea>
				</div>

				<div class="field">
					<label for="recipe_tags" class="label is-medium">Tags
						<span class="label-instruction">Separate each tag with a space. Hyphenate multi-word tags.</span>
					</label>
					<input type="text" class="input" name="recipe_tags" />
				</div>

				<div class="field">
					<label for="recipe_prep_time" class="label is-medium">
						Prep Time
						<span class="label-instruction">In minutes. e.g. 10</span>
					</label>
					<input type="text" class="input" name="recipe_prep_time" required/>
				</div>

				<div class="field">
					<label for="recipe_cook_time" class="label is-medium">
						Cook Time
						<span class="label-instruction">In minutes.</span>
					</label>
					<input type="text" class="input" name="recipe_cook_time" required placeholder="e.g. 10"/>
				</div>

				<div class="field">
					<label for="ingredient_name" class="label is-medium">
						Ingredients
						<span class="label-instruction">Place each ingredient on a new line in the order that you would like them to appear. Do not add line numbers</span>
					</label>
					<textarea class="textarea ingredient-textarea" required placeholder="e.g. 2 Cups Flour"></textarea>
					{{-- <textarea class="editor textarea" name="ingredient_name"></textarea> --}}
				</div>

				<div class="field">
					<label for="instructions_name" class="label is-medium">
						Instructions
						<span class="label-instruction">Place each instruction on a new line in the order that you would like them to appear. Do not add line numbers</span>
					</label>
					<textarea class="textarea instructions-textarea" required placeholder="e.g. Preheat oven to 450 degrees."></textarea>
					{{-- <textarea class="editorOrdered textarea" name="instructions_name"></textarea> --}}
				</div>

				<div class="field">
					<label for="recipe_images" class="label is-medium">
						Add Images
						<span class="label-instruction">Drag and drop images into the box below or click inside the box to activate a file browser.<br/><b>Note:</b> Images that are landscape orientation (wider than tall) will look the best.</span>
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
							<input type="radio" name="recipe_enable_comments" value="1" checked>
							Yes
						</label>
						<label class="radio">
							<input type="radio" name="recipe_enable_comments" value="0">
							No
						</label>
					</div>
				</div>

				<div class="field">
					<label for="recipe_additional_information" class="label is-medium">
						Additional Information
						<span class="label-instruction">Add any additional information here.</span>
					</label>
					<textarea class="textarea" name="recipe_additional_information"></textarea>
				</div>

				<div class="field is-grouped">
					<div class="control">
						<button class="button is-primary" name="share">Share Recipe</button>
					</div>
					<div class="control">
						<button class="button is-link">Cancel</button>
					</div>
				</div>
			</form>			
			<br/>
		</div>
	</section>

@stop