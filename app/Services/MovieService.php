<?php

namespace App\Services;


use App\Http\Requests\MovieRequest;
use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\MovieRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;

class MovieService extends AbstractService
{

    protected $repository;
    protected $validator;
    protected $categoryRepository;

    /**
     * PurchaseService constructor.
     * @param MovieRepository $repository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(MovieRepository $repository, CategoryRepository  $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * @param MovieRequest $request
     * @return LengthAwarePaginator|mixed
     */
    public function create(MovieRequest $request)
    {
        DB::beginTransaction();
        try {

            $path = $this->saveImageOnS3($request);

            $request->merge([
                'image_path' => $path
            ]);
            $data = $request->except('file');

            $movie = $this->repository
                ->create($data);


            DB::commit();
            return $movie;
        } catch (ValidatorException | \Exception $e) {
            Log::info("Erro na service criar produto");
            Log::error($e->getMessage());
            DB::rollBack();
        }
    }

    /**
     * @param MovieRequest $request
     * @param $id
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function updateMovie(MovieRequest $request, $id)
    {
        try {
            if (!$request->hasFile('file')) {
                return $this->repository->update($request->all(), $id);
            };
            $this->removeImageFromS3($request->path);
            $path = $this->saveImageOnS3($request);
            $request->merge([
                'path' => $path
            ]);
            $data = $request->except('file');
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            Log::info("Erro service de atualizar produto");
            Log::error($e->getMessage());
        }

    }

    /**
     * @param $id
     * @return null
     */
    public function removeMovie($id)
    {
        try {
            $store = $this->repository->find($id);
            $this->removeImageFromS3($store->path);
            return parent::delete($id);
        } catch (\Exception $e) {
            Log::info("Erro ao tentar apagar produto");
            Log::error($e->getMessage());
        }
    }

    /**
     * @param $image
     * @return bool
     */
    public function removeImageFromS3($image)
    {
        return Storage::disk('s3')->delete($image);
    }


    /**
     * @param $request
     * @return bool
     */
    public function saveImageOnS3($request)
    {
        $movie = $this->categoryRepository->find($request->category_id);
        $path = Str::of($movie->description)->replace(' ', '-')->lower();
        return Storage::disk('s3')->put($path, $request->file);
    }
}
