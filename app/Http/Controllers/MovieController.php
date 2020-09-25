<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Requests\ProductRequest;
use App\Movie;
use App\Services\MovieService;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class MovieController extends AbstractController
{
    protected $service;

    /**
     * PurchaseController constructor.
     * @param MovieService $service
     */
    public function __construct(MovieService $service)
    {
        $this->service = $service;
        $this->model = Movie::class;
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
     * @param MovieRequest $request
     * @return JsonResponse
     */
    public function store(MovieRequest $request)
    {
        try {
            $data = $this->service->create($request);
            return response()->json([
                'data' => $data,
                'success' => true
            ], Response::HTTP_CREATED);
        } catch (Exception $exception) {
            Log::info("Erro na controller criar filme");
            Log::error($exception->getMessage());
        }
    }

    /**
     * @param MovieRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(MovieRequest $request, $id)
    {
        try {
            $data = $this->service->updateMovie($request, $id);
            dd($data);
            return response()->json([
                'data' => $data,
                'success' => true
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            Log::info("Erro na controller atualizar filme");
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        return $this->service->removeMovie($id);
    }
}
