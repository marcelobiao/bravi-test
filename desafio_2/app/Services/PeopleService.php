<?php

namespace App\Services;

use App\Repositories\People\PeopleRepository;
use Exception;

class PeopleService
{
    private $model;

    public function __construct(PeopleRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->getAll();
    }

    public function getByUuid($uuid)
    {
        return $this->model->getByUuid($uuid);
    }

    public function getById($id)
    {
        return $this->model->getById($id);
    }

    public function getByFilter($attributes)
    {
        return $this->model->getByFilter($attributes);
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes)
    {
        return $this->model->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
