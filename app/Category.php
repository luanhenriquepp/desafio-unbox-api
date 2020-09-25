<?php

namespace App;

class Category extends AbstractModel
{
    protected $primaryKey = 'category_id';

    protected $table = 'tb_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description'
    ];
}
