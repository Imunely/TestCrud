<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'author_id', 'name'];

    public function authors()
    {
        return $this->belongsTo(Author::class);
    }
}
