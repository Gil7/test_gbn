<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
    	'name','author','category','published',
    	'user_id'
    ];
    public function current_user(){
    	return $this->belongsTo('App\User', 'user_id');
    }
    public function categories(){
    	return $this->belongsToMany(Category::class,'books_categories','book_id','category_id');
    }
}
