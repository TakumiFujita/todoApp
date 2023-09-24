<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderby('updated_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.show', compact('task'));
    }

    public function add()
    {
        return view('tasks.add');
    }

    public function store(TaskRequest $request)
    {
        $result = Task::create([
            'name' => $request->name,
            'content' => $request->content,
        ]);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        $task->fill([
            'name' => $request->name,
            'content' => $request->content,
        ])
            ->save();

        return redirect()->route('tasks.index');
    }

    public function delete($id)
    {
        $task = Task::destroy($id);
        return redirect()->route('tasks.index');
    }
}
