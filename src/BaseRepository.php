<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 8/3/2019
 * Time: 5:54 AM
 */

namespace Salemcode8\Repository;

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
        /** @noinspection StaticInvocationViaThisInspection */
        return $this->model->all();
    }

    public function find($id)
    {
        /** @noinspection StaticInvocationViaThisInspection */
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        /** @noinspection StaticInvocationViaThisInspection */
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
    public function destroy($id): bool
    {
        return $this->find($id)->delete();
    }

    public function modelData(): array
    {
        return $this->model->getFillable();
    }
}
