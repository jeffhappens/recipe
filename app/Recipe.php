<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // A recipe has:
    // An owner
    // A set of ingredients
    // A set of instructions
    // A set of tags
    

    public function owner() {
    	return $this->belongsTo('\App\User','recipe_author');
    }


    public function ingredients() {
    	return $this->hasMany('\App\Ingredient','ingredient_recipeid');
    }


    public function instructions() {
    	return $this->hasMany('\App\Instruction','instructions_recipeid');
    }


    public function media() {

    	return $this->hasMany('App\Media','media_recipeid');

    }

    public function tags() {

    	return $this->belongsToMany('App\Tag','recipes_tags');
    }


}
