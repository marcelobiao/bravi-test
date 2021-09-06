<?php

namespace App\Repositories\Phone;

use App\Models\Phone;

class PhoneEloquent implements PhoneRepository
{
    public function __construct(Phone $model)
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
                    if($field == 'number' && $value != null){
                        $query->where('number', 'like',  "%".$value. "%" );
                    }
                    else if($field == 'isWhatsapp' && $value != null){
                        $query->where('isWhatsapp', 'like', $value);
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
