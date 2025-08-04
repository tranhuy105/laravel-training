<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager loading: load the 'tasks' relationship with each user
        $users = User::with('tasks')->get();
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();
        
        // Set is_active as boolean and combine first_name and last_name
        $validated['is_active'] = $request->has('is_active');
        $validated['name'] = $request->first_name . ' ' . $request->last_name;
        
        // Create a new user using Eloquent
        User::create($validated);
        
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Eager load the tasks relationship
        $user->load('tasks');
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();
        
        $validated['is_active'] = $request->has('is_active');
        $validated['name'] = $request->first_name . ' ' . $request->last_name;
        
        // Update user with Eloquent
        $user->update($validated);
        
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Using Eloquent to delete the user
        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
