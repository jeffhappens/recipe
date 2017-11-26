<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeTag extends Model
{
	protected $fillable = ['tag_id','recipe_id'];
    protected $table = 'recipes_tags';
}
