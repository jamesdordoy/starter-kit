<?php

namespace App\Http\Controllers\Settings;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('settings/users/Index', [
            UserData::COLLECTION_NAME => UserData::collect(User::paginate()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
