<?php


namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

abstract class AbstractService
{
    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * AbstractService constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->service = $model;
    }

    /**
     * Returns a paginated list of Model.
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function all()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        return $this->repository->with($this->repository->relationships)->paginate(20);
    }

    /**
     * Data of a Model by primary key
     *
     * @param int|string $id
     *
     * @return mixed
     * @throws Exception
     */
    public function find($id)
    {
       return $this->repository->with($this->repository->relationships)->find($id);
    }

    /**
     * Store a newly created Model in storage.
     *
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function save(Request $request)
    {
        return $this->repository->create($request->all());
    }

    /**
     * Update the specified Model in storage.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function update(Request $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }

    /**
     * Remove the specified Model from storage.
     *
     * @param int|string $id
     *
     * @return null
     * @throws Exception
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
