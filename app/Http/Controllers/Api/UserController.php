<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserApiRequest;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    protected $user; 

    public function __construct(UserRepository $user)
    {
        $this->user = $user;   
    }
    /**
     * Display a listing of the resource.
     *1
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->get_all_users();
        return response()->success($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserApiRequest $request)
    {
        $user = $this->user->first_or_create($request->validated());
        return response()->success($user);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->get_user_by_id($id);
        try {
            if ($user) return response()->success($user);
            else throw new Exception('No such user (2)', 404);
        } catch(ModelNotFoundException $e) {
            return response()->error($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserApiRequest $request)
    {
        try {
            if ($request->only('id')) {
                $user = $this->user->create_or_update($request->validated(), $request->only('id'));
                return response()->success($user);
            } else throw new Exception('No such user (1)', 404);
        } catch(ModelNotFoundException $e) {
            return response()->error($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
