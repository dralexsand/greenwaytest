<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\Response
    {
        return User::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\Response
    {
        return User::create(
            $request->only(['name', 'email'])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): \Illuminate\Http\Response
    {
        return User::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): \Illuminate\Http\Response
    {
        $user = User::findOrFail($id);
        $user->update(
            $request->only(['name', 'email'])
        );
        return $user;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function updateManyUsers(Request $request): array
    {
        $requestAll = $request->all();

        $users = [];
        foreach ($requestAll as $update_user) {
            $user = User::findOrFail($update_user->id);
            $user->update([
                'name' => $update_user->name,
                'email' => $update_user->email
            ]);
            $users[] = $user;
        }

        return $users;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): \Illuminate\Http\Response
    {
        User::findOrFail($id)->delete();
    }

    public function destroyManyUsers(Request $request): array
    {
        $ids = $request->all();
        User::whereIn('id', $ids)->delete();
        return $ids;
    }
}
