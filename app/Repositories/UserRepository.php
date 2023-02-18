<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class UserRepository extends Repository
{

    /**
     *
     */
    public function __construct()
    {
        $this->model = User::class;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->model::query()->get();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        return $this->model::query()->create(attributes: $attributes + $this->createRegistrationCode($this->model));
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool|int
     */
    public function update(array $attributes, int $id): bool|int
    {
        return $this->model::query()->findOrFail($id)->update($attributes);
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder
     */
    public function show(int $id): Model|Collection|Builder
    {
        return $this->model::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed|null
     */
    public function destroy(int $id): mixed
    {
        return $this->model::query()->findOrFail($id)->delete();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function showByEmail($email): mixed
    {
        return $this->model::query()->whereEmail($email)->firstOrFail()->makeVisible('password');
    }

}