<?php

namespace App\Repositories;

use App\Models\Token;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class TokenRepository extends Repository
{

    /**
     * @var String | Builder|Model
     */
    private Model|Builder|string $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = Token::class;
    }

    /**
     * @return Builder|Collection
     */
    public function index(): Collection|Builder
    {
        return $this->model::query()->get();
    }

    /**
     * @param array $attributes
     * @return Builder|Model
     */
    public function store(array $attributes): Model|Builder
    {
        return $this->model::query()->create([
            "data" => $attributes
        ]);
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
     * @return Builder|Collection|Model|null
     */
    public function show(int $id): Model|Collection|Builder|null
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

}
