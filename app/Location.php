<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'title'
    ];

    public function objects() {
        return $this->hasMany(Material::class);
    }

    public function histories() {
        return $this->hasMany(History::class);
    }
    //
}
