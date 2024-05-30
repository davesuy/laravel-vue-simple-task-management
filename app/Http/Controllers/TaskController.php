<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('index');
    }

    public function fetchTasks()
    {

        return Task::all();

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

        $title = $request->input('title');

        $task = new Task();
        $task->title =  $title;
        $task->save();


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $task_title = $request->input('taskTitle');

        $task = Task::find($id);

        $task->title = $task_title;
        $task->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::destroy($id);


    }

    public function done(string $id) {

        $task = Task::find($id);
        $task->completed = true;
        $task->save();

    }


    public function undo(string $id) {

        $task = Task::find($id);
        $task->completed = false;
        $task->save();

    }
}
