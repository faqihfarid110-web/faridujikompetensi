<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Funfact extends Model {
    protected $fillable = [
        'slug', 'title', 'category', 'summary', 'img', 'source', 'author', 'date', 'content'
    ];
}
