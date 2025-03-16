<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetTag extends Model
{
    protected $fillable = [
        'pet_id',
        'tag_id'
    ];

    public $timestamps = false;

    protected $table = 'pet_tag';
}
