<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Recipe;

    class SearchController extends Controller {

        public function query($query) {
            $searchValues = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
            $selectArray = [
                'recipes.id',
                'recipes.recipe_title',
                'recipes.recipe_slug',
                'recipes.created_at',
                'recipes.recipe_description',
                'users.display_name',
                'users.id as userid',
                'media.media_filename'
            ];

            $recipes = \App\Recipe::join('users','users.id','=','recipes.recipe_author')

                ->where(function ($q) use ($searchValues) {
                    foreach ($searchValues as $value) {
                        $q->orWhere('recipe_title', 'like', "%{$value}%");
                    }
                })
                ->join('media','media.media_recipeid','=','recipes.id')
                ->where('recipes.active', 1)
                ->orderBy('recipes.created_at','desc')
                ->get($selectArray);

            $tags = \App\Tag::join('recipes_tags','recipes_tags.tag_id','=','tags.id')
                ->where(function ($q) use ($searchValues) {
                    foreach ($searchValues as $value) {
                        $q->orWhere('tags.tag_content', 'like', "%{$value}%");
                    }
                })
                ->join('recipes','recipes.id','=','recipes_tags.recipe_id')
                ->join('media','media.media_recipeid','=','recipes.id')
                ->join('users','users.id','=','recipes.recipe_author')
                ->orderBy('recipes.created_at','desc')
                ->where('recipes.active', 1)
                ->get($selectArray);

            $results = $recipes->merge($tags);

            if(!$results->count()) {
                $data = [
                    'query' => $query
                ];
                return view('search.noresults', $data);
            }
            $data = [
                'recipes' => $results,
                'query' => $query
            ];
            return view('search.results', $data);

        }
}
