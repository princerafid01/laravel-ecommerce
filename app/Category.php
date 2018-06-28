<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    // protected $hidden = ['publication_status'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
