<?php

namespace App\Repositories\People;

use App\Models\People;

class PeopleEloquent implements PeopleRepository
{
    public function __construct(People $model)
    {
        return $this->model = $model;
    }

    public function getAll()
    {
        return $this->model
            ->with(['phones', 'emails'])
            ->orderBy('id', 'Desc')
            ->get();
    }

    public function getByUuid($uuid)
    {
        return $this->model
            ->with(['phones', 'emails'])
            ->where('uuid', $uuid)
            ->orderBy('id', 'Desc')
            ->first();
    }

    public function getById($id)
    {
        return $this->model
            ->with(['phones', 'emails'])
            ->where('id', $id)
            ->orderBy('id', 'Desc')
            ->first();
    }

    public function getByFilter(array $filters)
    {
        return $this->model
            ->with(['phones', 'emails'])
            ->where(function ($query) use ($filters){
                foreach ($filters as $field => $value) {
                    if($field == 'name' && $value != null){
                        $query->where('name', 'like',  "%".$value. "%" );
                    }
                    else if($field == 'nickname' && $value != null){
                        $query->where('nickname', '%' . $value . '%' );
                    }
                    else{
                        $query->where($field, $value);
                    }
                }
            })
            ->orderBy('id', 'Desc')
            ->get();
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes)
    {
        $order = $this->model->find($id);
        return $order->update($attributes);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
