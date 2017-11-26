<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
{
    public function recipe($id, $slug) {
        $recipe = Recipe::with('owner')
            ->with('ingredients')
            ->with('instructions')
            ->with('tags')
            ->with('media')
            ->find($id);
        return view('recipes.recipe', compact('recipe'));
    }

    public function userRecipes($id) {
    	$recipes = Recipe::with('tags')
        	->with('ingredients')
        	->with('instructions')
        	->with('media')
        	->where('recipe_author', $id)
        	->latest()
        	->get();
        $recipeAuthor = \App\User::find($id);
        $canEdit = \Auth::check() && ($recipeAuthor->id === \Auth::user()->id);
        if($recipes->count() < 1) {
            return view('user.norecipes');
        }
        return view('user.recipes', compact(['recipes','canEdit','recipeAuthor']));
    }

    public function create() {
        return view('recipes.create');
    }

    public function createArrayFromTextareaContent($string) {
        return explode("\n", str_replace("\r", "", $string));
    }

    public function post_create(Request $request) {
        $recipe = new \App\Recipe;
        $recipe->recipe_title = $request->get('recipe_title');
        $recipe->recipe_slug = str_slug($request->get('recipe_title'));
        $recipe->recipe_author = \Auth::user()->id;
        $recipe->recipe_description = $request->get('recipe_description');
        $recipe->recipe_prep_time = $request->get('recipe_prep_time');
        $recipe->recipe_cook_time = $request->get('recipe_cook_time');
        $recipe->recipe_enable_comments = $request->get('recipe_enable_comments');
        $recipe->recipe_additional_information = $request->get('recipe_additional_information');
        $recipe->save();
        // Ingredients
        //$ingredientsArray = explode("\n", str_replace("\r", "", $request->get('ingredients')));
        $ingredientsArray = $this->createArrayFromTextareaContent($request->get('ingredients'));
        foreach($ingredientsArray as $key=>$value) {
            $i = new \App\Ingredient;
            $i->ingredient_name = $value;
            $i->ingredient_recipeid = $recipe->id;
            $i->ingredient_sort = $key;
            $i->save();
        }
        // Instructions
        //$instructionsArray = explode("\n", str_replace("\r", "", $request->get('instructions')));
        $instructionsArray = $this->createArrayFromTextareaContent($request->get('instructions'));
        foreach($instructionsArray as $key=>$value) {
            $i = new \App\Instruction;
            $i->instructions_name = $value;
            $i->instructions_recipeid = $recipe->id;
            $i->instructions_sort = $key;
            $i->save();
        }

        // Shares
        $u = \App\User::find(\Auth::user()->id)->increment('sharecount');
        $u = \App\User::find(\Auth::user()->id)->increment('invites');

        // Tags
        $tags = explode(',', $request->get('recipe_tags'));
        foreach($tags as $tag) {
            $t = \App\Tag::firstOrCreate(['tag_content' => $tag]);
            $rt = \App\RecipeTag::firstOrCreate(['tag_id' => $t->id, 'recipe_id' => $recipe->id ]);
        }

        // Media
        foreach($request->get('uploads') as $upload) {
            $i = \App\Media::firstOrCreate(['media_filename' => str_replace(' ','_', $upload), 'media_recipeid' => $recipe->id ]);
        }
        return redirect('/');
    }





    public function edit($id) {
        $recipe = \App\Recipe::with('tags')
        ->with('ingredients')
        ->with('instructions')
        ->with('media')
        ->find($id);
        if($recipe->recipe_author !== \Auth::user()->id) {
            \Session::flash('error','You do not have permission to perform that action');
            return redirect('/');
        }
        return view('recipes.edit', compact(['recipe','ingredients']));
    }

    public function post_edit(Request $request, $id) {

        $recipe = \App\Recipe::find($id);
        $recipe->active = $request->get('recipe_status');
        $recipe->recipe_title = $request->get('recipe_title');
        $recipe->recipe_slug = str_slug($request->get('recipe_title'));
        $recipe->recipe_description = $request->get('recipe_description');
        $recipe->recipe_prep_time = $request->get('recipe_prep_time');
        $recipe->recipe_cook_time = $request->get('recipe_cook_time');
        $recipe->recipe_enable_comments = $request->get('recipe_enable_comments');
        $recipe->recipe_additional_information = $request->get('recipe_additional_information');
        $recipe->save();

        if($request->get('recipe_tags')) {
            $tags = explode(',', $request->get('recipe_tags'));
            foreach($tags as $tag) {
                $t = \App\Tag::firstOrCreate(['tag_content' => $tag]);
                $tr =\App\RecipeTag::firstOrCreate(['tag_id' => $t->id, 'recipe_id' => $recipe->id ]);
            }
        }

        // Ingredients
        //$ingredientsArray = explode("\n", str_replace("\r", "", $request->get('ingredients')));
        $ingredientsArray = $this->createArrayFromTextareaContent($request->get('ingredients'));
        foreach($ingredientsArray as $key=>$value) {
            $i = \App\Ingredient::updateOrCreate(
                [
                    'ingredient_recipeid' => $recipe->id,
                    'ingredient_sort' => $key
                ],
                [
                    'ingredient_name' => $value,
                    'ingredient_recipeid' => $recipe->id,
                    'ingredient_sort' => $key
                ]
            );
        }

        // Instructions
        //$instructionsArray = explode("\n", str_replace("\r", "", $request->get('instructions')));
        $instructionsArray = $this->createArrayFromTextareaContent($request->get('instructions'));
        foreach($instructionsArray as $key=>$value) {
            $i = \App\Instruction::updateOrCreate(
                [
                    'instructions_recipeid' => $recipe->id,
                    'instructions_sort' => $key
                ],
                [
                    'instructions_name' => $value,
                    'instructions_recipeid' => $recipe->id,
                    'instructions_sort' => $key
                ]
            );
        }

        if($request->get('uploads')) {
            foreach($request->get('uploads') as $upload) {
                $i = \App\Media::firstOrCreate(['media_filename' => $upload, 'media_recipeid' => $recipe->id]);
            }
        }
        \Session::flash('success','Recipe has been updated!');
        return redirect('/recipe/'.$recipe->id.'/'.$recipe->recipe_slug);
    }



    public function deleteTag(Request $request) {
        $tag = \App\RecipeTag::where([
            'tag_id' => $request->get('tagid'),
            'recipe_id' => $request->get('recipeid')
        ])->delete();

        return response()->json($request);
        

    }

    public function deleteImage(Request $request) {
        $tag = \App\Media::where([
            'media_filename' => $request->get('media_filename'),
            'media_recipeid' => $request->get('media_recipeid')
        ])->delete();

        return response()->json($request);
        

    }


















    public function uploadImage(Request $request) {


        // Original Size
        $img = \Image::make($_FILES['file']['tmp_name']);
        $trimmed = trim(str_replace(' ','_', $_FILES['file']['name']));


        $width = $img->width();
        $height = $img->height();


        // Make the Banner
        $banner = \Image::make($_FILES['file']['tmp_name']);
        $banner->resize(1500, null, function($constraint) {
            $constraint->aspectRatio();
        })->save($_SERVER['DOCUMENT_ROOT'].'/uploads/lg/'.$trimmed);

        // Make the square thumbs
        $mediumThumb = \Image::make($_FILES['file']['tmp_name']);
        $mediumThumb->crop($height, $height)->resize(650,650)->save($_SERVER['DOCUMENT_ROOT'].'/uploads/md/'.$trimmed);

        $smallThumb = \Image::make($_FILES['file']['tmp_name']);
        $smallThumb->crop($height, $height)->resize(350,350)->save($_SERVER['DOCUMENT_ROOT'].'/uploads/sm/'.$trimmed);

        $xsmallThumb = \Image::make($_FILES['file']['tmp_name']);
        $xsmallThumb->crop($height, $height)->resize(150,150)->save($_SERVER['DOCUMENT_ROOT'].'/uploads/xs/'.$trimmed);



/*        $img->save($_SERVER['DOCUMENT_ROOT'].'/uploads/lg/'.$trimmed);

        // Medium Thumbnail
        $img = \Image::make($_FILES['file']['tmp_name'])->resize(350, null, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($_SERVER['DOCUMENT_ROOT'].'/uploads/md/'.$trimmed);

        // Small Thumbnail
        $img = \Image::make($_FILES['file']['tmp_name'])->resize(100, null, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($_SERVER['DOCUMENT_ROOT'].'/uploads/sm/'.$trimmed);
*/    }
}
