<?php

namespace App\Repositories;

use App\Category;
use App\Validators\CategoryValidator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PurchaseRepository.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepository extends BaseRepository
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
        return Category::class;
    }

    /**
     * @return string|null
     */
    public function validator()
    {
        return CategoryValidator::class;
    }
}
