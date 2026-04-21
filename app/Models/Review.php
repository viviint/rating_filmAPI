<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'film_title',
        'reviewer_name',
        'rating',
        'comment'
    ];
}
