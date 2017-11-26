<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    protected $fillable = ['instructions_name','instructions_recipeid','instructions_sort'];
}
