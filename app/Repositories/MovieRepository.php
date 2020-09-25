<?php

namespace App\Repositories;

use App\Movie;
use App\Validators\MovieValidator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PurchaseRepository.
 *
 * @package namespace App\Repositories;
 */
class MovieRepository extends BaseRepository
{

    public $relationships = [
    ];

    protected $fieldSearchable = [
        'title' => 'ilike',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Movie::class;
    }

    /**
     * @return string|null
     */
    public function validator()
    {
        return MovieValidator::class;
    }
}
