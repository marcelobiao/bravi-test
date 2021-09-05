<?php

namespace App\Repositories\People;

interface PeopleRepository
{
    public function getAll();

    public function getByUuid($uuid);

    public function getById($id);

    public function getByFilter(array $filters);

    public function create(array $attributes);

    public function update($id, $attributes);

    public function delete($id);

}
