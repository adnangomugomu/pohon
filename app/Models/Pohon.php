<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Pohon extends Model
{
    use SoftDeletes;
    protected $table = 'pohon';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($dt) {
            $dt->foto()->delete();
        });

        static::addGlobalScope('order', function (EloquentBuilder $builder) {
            $builder->orderBy('id', 'desc');
        });
    }

    public function tajuk()
    {
        return $this->belongsTo(Ref_tajuk::class, 'tajuk_id', 'id');
    }

    public function kondisi()
    {
        return $this->belongsTo(Ref_kondisi::class, 'kondisi_id', 'id');
    }

    public function akar()
    {
        return $this->belongsTo(Ref_akar::class, 'akar_id', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo(Ref_jenis::class, 'jenis_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kode_kec', 'kode_wilayah');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kode_kel', 'kode_wilayah');
    }

    public function foto()
    {
        return $this->hasMany(Pohon_foto::class, 'pohon_id', 'id');
    }

    public function scopeWithJarak(EloquentBuilder $query, $latitude, $longitude)
    {
        $query->select(
            'latitude',
            'longitude',
            'nama_indo',
            'nama_latin',
            DB::raw('ST_Distance_Sphere(POINT(?, ?), koordinat) AS jarak_meter')
        )
            ->addBinding([$longitude, $latitude], 'select')
            ->orderBy('jarak_meter', 'asc');
    }
}
