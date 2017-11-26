<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

	// Always include these relationships with every instance of App\Recipe
	protected $with = ['owner','ingredients','instructions','media','tags'];
    
    
    public function owner() {
    	
    	return $this->belongsTo('App\User','recipe_author');

    }


    public function ingredients() {

    	return $this->hasOne('App\Ingredient','ingredient_recipeid');

    }

    public function instructions() {

    	return $this->hasOne('App\Instruction','instructions_recipeid');

    }

    public function media() {

    	return $this->hasMany('App\Media','media_recipeid');

    }

    public function tags() {

    	return $this->belongsToMany('App\Tag','recipes_tags');
    }
}
