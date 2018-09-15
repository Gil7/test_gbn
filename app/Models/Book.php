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
    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
    public function categories(){
    	return $this->belongsToMany(Category::class,'books_categories','category_id','book_id');
    }
}
