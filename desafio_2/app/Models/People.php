<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory, UuidTrait;

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
