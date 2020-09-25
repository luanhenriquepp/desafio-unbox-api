<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends AbstractController
{

    protected $service;

    /**
     * PurchaseController constructor.
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
        $this->model = Category::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return parent::index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        return parent::save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function show($id)
    {
        return parent::show($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        return parent::updateAs($request, $id);
    }

    /**
    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        return parent::delete($id);
    }
}
