<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Movie extends AbstractModel
{
    protected $primaryKey = 'movie_id';

    protected $table = 'tb_movies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'summary',
        'duration',
        'image_path',
        'category_id'
    ];

    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->image_path);
    }

    protected $appends = [
        'url'
    ];
}
