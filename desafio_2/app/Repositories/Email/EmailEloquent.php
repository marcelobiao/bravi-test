<?php

namespace App\Repositories\Email;

use App\Models\Email;

class EmailEloquent implements EmailRepository
{
    public function __construct(Email $model)
    {
        return $this->model = $model;
    }

    public function getAll()
    {
        return $this->model
            ->orderBy('id', 'Desc')
            ->get();
    }

    public function getByUuid($uuid)
    {
        return $this->model
            ->where('uuid', $uuid)
            ->orderBy('id', 'Desc')
            ->first();
    }

    public function getById($id)
    {
        return $this->model
            ->where('id', $id)
            ->orderBy('id', 'Desc')
            ->first();
    }

    public function getByFilter(array $filters)
    {
        return $this->model
            ->where(function ($query) use ($filters){
                foreach ($filters as $field => $value) {
                    if($field == 'email' && $value != null){
                        $query->where('email', 'like',  "%".$value. "%" );
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
