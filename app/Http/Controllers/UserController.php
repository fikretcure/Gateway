<?php

namespace App\Http\Controllers;


use App\Helpers\UserHelper;
use App\Http\Middleware\AuthenticationMiddleware;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\TokenRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;


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
     * @var TokenRepository
     */
    private TokenRepository $tokenRepository;

    /**
     * @var UserHelper
     */
    private UserHelper $userHelper;

    /**
     *
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->tokenRepository = new TokenRepository();
        $this->userHelper = new UserHelper();
        $this->middleware(AuthenticationMiddleware::class)->except('store', 'login');
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

    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $user = $this->userRepository->getUserFromEmail($request->validated("email"));
        if (Hash::check($request->password, $user->password)) {
            $bearer = str()->uuid();
            $refresh = str()->uuid();
            $user_id = $user->id;

            $remote_addr = $request->server("REMOTE_ADDR");
            $server_addr = $request->server("SERVER_ADDR");
            $http_user_agent = $request->server("HTTP_USER_AGENT");

            $this->tokenRepository->store(compact("user_id", "bearer", "refresh", "remote_addr", "server_addr", "http_user_agent"));
            $this->userHelper->setCacheToken($bearer, $refresh);

            return $this->success()->send();
        }
        return $this->failMes("Bilgilerini tekrar girerek denemelisin !")->send();
    }
}
