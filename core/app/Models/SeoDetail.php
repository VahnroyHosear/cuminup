<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoDetail extends Model
{
    protected $table = 'seo_details';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page', 'title', 'key_words', 'content', 'status'
    ];
}
