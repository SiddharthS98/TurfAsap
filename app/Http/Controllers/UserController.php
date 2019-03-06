<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\User;
use Illuminate\Http\Request;
use Kyros\Responses\JSONResponse;
use Turfasap\ModelRepository\UserRepository;

class UserController extends Controller
{

    private $repo;

    public function __construct(UserRepository $repository)
    {

        $this->repo = $repository;
    }

    public function getUserImage ($id) {
        return $this->repo->retrieveUserImage($id);
    }

    public function verify(AdminRequest $request, JSONResponse $response, $id) {
        $u = User::find($id);
        $u->verified = 1;
        $u->save();

        return $response->success()->make();
    }
}
