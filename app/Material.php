<?php

namespace App;

use App\Filters\QueryFilter;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use Sluggable;

    protected $table = 'objects';

    protected $fillable = [
        'inv_number',
        'title',
        'location_id',
        'date_buy',
        'type_id',
        'status_id',
        'price',
    ];

    public function getDateBuy($date) {
        return Carbon::parse($date)->format('d.m.Y'); ;
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function histories() {
        return $this->hasMany(History::class, 'object_id');
    }

//    public function historiesObj() {
//        return $this->hasOne(History::class, 'location_object');
//    }

    public function abbreviation() {
        return $this->hasOne(Abbreviation::class, 'object_id');
    }

    public function invoices() {
        return $this->belongsToMany(Invoice::class, 'invoice_object', 'object_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter){

        return $filter->apply($builder);
    }

}
