<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunfactFeedback extends Model
{
    use HasFactory;

    protected $table = 'funfact_feedback';

    protected $fillable = [
        'slug',
        'name',
        'comment',
        'rating',
    ];
}
