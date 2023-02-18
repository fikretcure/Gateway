<?php

namespace App\Http\Controllers;


use App\Http\Middleware\AuthenticationMiddleware;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->middleware(AuthenticationMiddleware::class)->except('store');
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->userRepository->index())->send();
    }

    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        return $this->success($this->userRepository->store($request->validated()))->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->success($this->userRepository->show($id))->send();
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        return $this->success($this->userRepository->update($request->validated(), $id))->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->success($this->userRepository->destroy($id))->send();
    }
}
