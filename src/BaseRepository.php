<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 8/3/2019
 * Time: 5:54 AM
 */

namespace SalemCode8\Repository;

use Exception;
use Illuminate\Http\JsonResponse;
use ReflectionClass;
use ReflectionException;

class BaseRepository implements RepositoryInterface
{
    protected $model;


    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        if (!$this->model) {
            $this->setModelName();
        }else{
            $this->model = new $this->model;
        }
    }

    /**
     * @throws ReflectionException
     */
    protected function setModelName(): void
    {
        $model = 'App\\' . str_replace('Repository', '', (new ReflectionClass($this))->getShortName());
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);

        return $model;
    }

    /**
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }

    public function modelData()
    {
        return $this->model->getFillable();
    }
}
