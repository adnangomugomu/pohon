<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use SoftDeletes;
    protected $table = 'laporan';  

    public function status()
    {
        return $this->belongsTo(Ref_status::class, 'status_id', 'id');
    }
}
