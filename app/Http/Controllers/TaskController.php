<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = DB::table('tasks')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('tasks.*', 'users.name as user_name')
            ->get();
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = DB::table('users')->select('id', 'name')->where('is_active', true)->get();
        return view('tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $validated = $request->validated();
        
        DB::table('tasks')->insert([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'due_date' => $validated['due_date'] ?? null,
            'user_id' => $validated['user_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = DB::table('tasks')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('tasks.*', 'users.name as user_name')
            ->where('tasks.id', $id)
            ->first();
            
        if (!$task) {
            return abort(404);
        }
        
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        
        if (!$task) {
            return abort(404);
        }
        
        $users = DB::table('users')->select('id', 'name')->where('is_active', true)->get();
        
        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        
        if (!$task) {
            return abort(404);
        }
        
        $validated = $request->validated();
        
        DB::table('tasks')
            ->where('id', $id)
            ->update([
                'title' => $validated['title'] ?? $task->title,
                'description' => $validated['description'] ?? $task->description,
                'status' => $validated['status'] ?? $task->status,
                'due_date' => $validated['due_date'] ?? $task->due_date,
                'user_id' => $validated['user_id'] ?? $task->user_id,
                'updated_at' => now(),
            ]);
            
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        
        if (!$task) {
            return abort(404);
        }
        
        DB::table('tasks')->where('id', $id)->delete();
        
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
