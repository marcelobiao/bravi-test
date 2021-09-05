<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'nickname',
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
    ];

    public function phones()
    {
        return $this->hasMany(Phone::class, 'people_id');
    }
    
    public function emails()
    {
        return $this->hasMany(Email::class, 'people_id');
    }
}
