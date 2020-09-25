<?php


namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class AbstractController extends Controller
{

    protected $service;
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = $this->service->all();
        return response()->json([
            'data' => $data,
            'message' => 'Lista'
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function show($id)
    {
        $data = $this->service->find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Detalhe'
        ], Response::HTTP_OK);
    }

    /**
     * Store.
     *
     * @param $request
     * @return JsonResponse
     */
    public function save($request)
    {
        $data = $this->service->save($request);
        return response()->json([
            'data' => $data,
            'message' => 'Criado com sucesso!'
        ], Response::HTTP_OK);
    }

    /**
     * Store.
     *
     * @param $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function updateAs($request, $id)
    {
        $data = $this->service->update($request, $id);
        return response()->json([
            'data' => $data,
            'message' => 'Atualizado com sucesso!'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete($id)
    {
        $data = $this->service->delete($id);
        return response()->json([
            'success' => $data,
            'message' => 'Deletado com sucesso!'
        ], Response::HTTP_OK);
    }
}
