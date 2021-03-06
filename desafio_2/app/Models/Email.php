<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'email',
        'people_id',
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
    ];

    public function people(){
        return $this->belongsTo(People::class, 'people_id');
    }
}
