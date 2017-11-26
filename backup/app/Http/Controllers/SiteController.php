<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{


    public function getMainImageById($id) {
        $foo = \App\Media::where('media_recipeid', $id)->orderby('sort_order')->first();
        if($foo['media_filename']) {
            return $foo['media_filename'];
        }
        else {
            return false;
        }

    }


    public function index() {
        $recipes = \App\Recipe::latest()->get();

        return response()->json($recipes);

        return view('home.index', compact('recipes'));

/*        $data = [
            'recipes' => \App\Recipe::join('users','users.id','=','recipes.recipe_author')
            ->select(
                'users.display_name',
                'recipes.id',
                'recipes.recipe_title',
                'recipes.recipe_slug',
                'recipes.created_at',
                'recipes.recipe_description'
            )
            ->orderby('recipes.id','desc')
            ->get()
        ];
        return view('home.index', $data);
*/        
    }

    public function recipe($recipeid, $slug) {
        $recipe = \App\Recipe::find($recipeid);
        return view('recipe.index', compact('recipe'));

/*        $data = [
            'recipe' => \App\Recipe::join('users','users.id','=','recipes.recipe_author')
                ->join('media','media.media_recipeid','=','recipes.id')
                ->select(
                    'users.display_name',
                    'recipes.recipe_title',
                    'recipes.recipe_slug',
                    'recipes.created_at',
                    'recipes.recipe_description',
                    'recipes.recipe_enable_comments',
                    'recipes.recipe_additional_information'
                )
                ->where('recipes.recipe_slug', $slug)
                ->find($recipeid),
            'ingredients' => \App\Ingredient::where('ingredients.ingredient_recipeid', $recipeid)
                ->get(),
            'instructions' => \App\Instruction::where('instructions.instructions_recipeid', $recipeid)
                ->get(),
            'media' => \App\Media::where('media_recipeid', $recipeid)->orderby('sort_order')->get(),
            'tags' => \App\Tag::join('recipes_tags','recipes_tags.tag_id','=','tags.id')
                ->where('recipes_tags.recipe_id', $recipeid)
                ->distinct()
                ->get(['tags.tag_content'])
        ];        
        return view('recipe.index', $data);
*/        
    }

    public function getMyRecipes() {
        $data = [
            'recipes' => \App\Recipe::where('recipe_author', \Auth::user()->id)->get()
        ];
        return view('recipe.mine', $data);
    }



    public function share() {
        return view('recipe.share');
    }

    public function share_post(Request $request) {

        $recipe = new \App\Recipe;
        $recipe->recipe_title = $request->get('recipe_title');
        $recipe->recipe_slug = str_slug($request->get('recipe_title'), '-');
        $recipe->recipe_description = $request->get('recipe_description');
        $recipe->recipe_author = \Auth::user()->id;
        $recipe->recipe_prep_time = $request->get('recipe_prep_time');
        $recipe->recipe_cook_time = $request->get('recipe_cook_time');
        $recipe->recipe_enable_comments = (int) $request->get('recipe_enable_comments');
        $recipe->recipe_additional_information = $request->get('recipe_additional_information');

        $recipe->save();

        $ingredients = new \App\Ingredient;
        $ingredients->ingredient_name = $request->get('ingredient_name');
        $ingredients->ingredient_recipeid = $recipe->id;
        $ingredients->save();

        $instructions = new \App\Instruction;
        $instructions->instructions_name = $request->get('instructions_name');
        $instructions->instructions_recipeid = $recipe->id;
        $instructions->save();

        $tags = explode(',', $request->get('recipe_tags'));
        foreach($tags as $tag) {
            $t = \App\Tag::firstOrNew(['tag_content' => $tag]);
            $t->save();

            $tr = new \App\TagRecipe;
            $tr->tag_id = $t->id;
            $tr->recipe_id = $recipe->id;
            $tr->save();
        }

        \App\User::where('id', \Auth::user()->id)->increment('sharecount');

        return response()->json($recipe->id);
    }



    public function refer(Request $request) {
        $sender = $request->get('sender');
        $recipient = $request->get('recipient');

        $u = \App\User::find($sender);

        // New up the invitation
        $user = new \App\Invitation;
        $user->email = $recipient;
        $user->token = str_random(48);
        $user->save();

        // Get sender data
        $data = [
            'first_name' => $u->first_name,
            'last_name' => $u->last_name,
            'email' => $recipient,
            'invite_token' => $user->token,
            'inviter' => $u->display_name
        ];


        \Mail::send('emails.invite', $data, function($message) use ($data) {
            $message->to($data['email'], $data['first_name'].' '.$data['last_name'])->subject('Welcome!');
        });




        return response()->json(['status' => 1]);


    }



    public function postRefer($email, $token) {
        $user = \App\Invitation::where([
            'email' => $email,
            'token' => $token
        ])->get();


        $data = [
            'user' => $user
        ];
        if(count($user)) {
            return view('invitations.setup', $data);
        }
        else {
            return view('invitations.invalid');
        }
    }



    public function postReferComplete($email, $token, Request $request) {

        $user = new \App\User;
        $user->username = $request->get('username');
        $user->password = \Hash::make($request->get('password'));
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->display_name = $request->get('first_name').' '.$request->get('last_name');
        $user->role = 'user';
        $user->save();

        $invitation = \App\Invitation::where('email', $email)->delete();

        $request->session()->flash('newuser','Thanks for signing up '.$user->first_name.'!');

        return redirect('/auth/login');





    }


}
