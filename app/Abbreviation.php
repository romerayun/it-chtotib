<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abbreviation extends Model
{
    protected $fillable = [
        'object_id',
        'abbr'
    ];
//
//    public function object() {
//        return $this->belongsTo(Material::class);
//    }
}
