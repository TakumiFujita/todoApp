<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderby('deadline', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.show', compact('task'));
    }

    public function add()
    {
        $nowDate = now()->format('Y-m-d');
        return view('tasks.add', compact('nowDate'));
    }

    public function store(TaskRequest $request)
    {
        $result = Task::create([
            'name' => $request->name,
            'content' => $request->content,
            'deadline' => $request->deadline,
        ]);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $nowDate = now()->format('Y-m-d');
        $task = Task::find($id);
        return view('tasks.edit', compact('task', 'nowDate'));
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        $task->fill([
            'name' => $request->name,
            'content' => $request->content,
            'deadline' => $request->deadline,
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
