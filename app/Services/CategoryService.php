<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService extends AbstractService
{

    protected $repository;
    protected $validator;

    /**
     * PurchaseService constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
}
