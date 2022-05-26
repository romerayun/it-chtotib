<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Sluggable;

    protected $fillable = ['name'];

    // Relation with Model - Object
    public function objects() {
        return $this->hasMany(Material::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
