<?php

namespace App\Http\Controllers;


use App\User;

class UserController extends Controller
{
    /**
     * @var user
     */
    private $user;


    /**
     * UserController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * List all users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        $users = array('users' => $this->user->select('email')->get());

        if (empty($users["users"])) { // No result
            return response()->json($users, 404);
        }

        return response()->json($users);
    }


}
