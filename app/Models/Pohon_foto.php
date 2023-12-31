<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pohon_foto extends Model
{
    use SoftDeletes;
    protected $table = 'pohon_foto';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (EloquentBuilder $builder) {
            $builder->orderBy('id', 'asc');
        });
    }
}
