<?php

namespace App;
use App\Article;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'famille', 'num',
    ];

     public function articles()
    {
        return $this->hasMany('App\Article');
    }
   
}
