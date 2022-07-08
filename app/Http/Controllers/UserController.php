<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{ 
    protected $user;

    public function __construct(UserRepository $user) {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $user = $id ? $this->user->get_user_by_id($id) : $this->user->get_user_by_id(1);
        return view('welcome', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $user = $this->user->create_or_update($request->validated());
            return view('welcome', compact('user'));
        } catch (Exception $e) {
            Log::error($e->getMessage . " Code: {$e->getCode()}");
            abort($e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $user = $this->user->get_user_by_id($id);
            return view('welcome', compact('user'));
        } else {
            abort(422, "Missing key value for ID.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $int
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            if ($id) {
                $user = $this->user->create_or_update($request->validated(), $id);
                return view('welcome', compact('user'));
            } else throw new Exception("Missing key/value for id", 422);
        } catch (Exception $e) {
            Log::error($e->getMessage . " Code: {$e->getCode()}");
            abort($e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
