<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $guarded = [];


    public function user () {
        return $this->belongsTo(User::class);
    }

    //Mutator
    public function setPostImageAttribute($value) {

        $this->attributes['post_image'] = asset($value);
    }

    //Assesor
    public function getPostImageAttribute($value) {

        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            
            return $value;
        }
        
        return asset('storage/' . $value);
    }
    
        
    
}
