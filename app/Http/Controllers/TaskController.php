<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $completed = Task::where('completed', 1)->count();
        $notCompleted = Task::where('completed', 0)->count();
        $all = Task::all()->count();
        return ['data' => $all, 'completed' => $completed, 'notCompleted' => $notCompleted];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
        $task->description = $request->description;
        $task->completed = $request->completed;
        $task->save();
        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->completed = $request->completed;
        $task->save();
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return 204;
    }

    public function pagination()
    {
        $users = Task::latest()->paginate(10);
        return \Response::json($users, 200);
    }
}
