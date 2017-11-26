@include('includes.head')
<body>
    @include('includes.header')

    <section class="share-recipe">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Share a Recipe</h2>
                    <br/>
                    <form name="share" role="form" class="moo" method="post" action="/recipe/create">
                        {{ csrf_field() }}

                        <div class="form-group col-md-12">
                            <label for="recipe_title">Recipe Title</label>
                            <input type="text" name="recipe_title" class="form-control" />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipe_description">Recipe Description</label>
                            <textarea name="recipe_description" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipe_tags">Tags <small>(seperate with a space)</small></label>
                            <input type="text" class="form-control" name="recipe_tags" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="recipe_prep_time">Prep Time</label>
                            <input type="text" class="form-control" name="recipe_prep_time" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="recipe_cook_time">Cook Time</label>
                            <input type="text" class="form-control" name="recipe_cook_time" />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="ingredient_name">Ingredients</label>
                            <textarea class="editor form-control" name="ingredient_name"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="instructions_name">Instructions</label>
                            <textarea class="editorOrdered form-control" name="instructions_name"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="recipe_images">Add Images</label>
                            <div class="dZone" id="myDropzone">
                                <p>Drop files here to upload.</p>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipe_enable_comments">Allow Comments</label>
                            <div class="radio">
                                <label><input type="radio" name="recipe_enable_comments" value="1">Yes</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="recipe_enable_comments" value="0">No</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipe_additional_information">Additional Information</label>
                            <textarea class="form-control" name="recipe_additional_information"></textarea>
                        </div>

                    </form>
                </div>
                <div class="col-md-12">
                    <div class="form-group">

                        <button disabled="disabled" name="share" class="btn btn-primary">Share Recipe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.footer')
    @include('includes.scripts')
</body>
</html>
