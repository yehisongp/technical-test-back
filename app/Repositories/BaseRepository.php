<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository {
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all() {
        return $this->model->all();
    }
    public function allPaginate($paginate = 5)
    {
        return $this->model->paginate($paginate);
    }
    public function save(Model $model): Model
    {
        $model->save();
        return $model;
    }
    public function update($id, array $data)
    {
        $user = $this->model->findOrFail($id);
        $user->update($data);
        return $user;
    }
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
