<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sekolah extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    // generate slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // insert slug
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
