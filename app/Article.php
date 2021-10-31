<?php

namespace App;
use App\Categories;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
	protected $fillable = [
        'name', 'famille','categories_id','image',
    ];



    public function categories()
    {
        return $this->belongsTo('App\Categories');
    }

}
