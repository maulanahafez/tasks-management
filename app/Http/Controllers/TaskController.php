<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $data = [
            'tasks' => Task::latest()->get(),
        ];

        return view('index', $data);
    }

    public function store(Request $req){
        $validated = $req->validate([
            'judul' => ['required'],
            'deskripsi' => ['required'],
        ]);

        $newTask = Task::create($req->except('_token'));

        return redirect()->route('task.index')->with('successStore', 'Task added successfully');
    }

    public function show(Task $task){

    }

    public function edit(Task $task){
        $data = [
            'task' => $task,
        ];

        return view('edit', $data);
    }

    public function update(Task $task, Request $req){
        $validated = $req->validate([
            'judul' => ['required'],
            'deskripsi' => ['required'],
            'status' => ['required'],
        ]);

        $task->update($req->except('_token', '_method'));
        return redirect()->route('task.index')->with('successUpdate', 'Task updated successfully');
    }

    public function destroy(Task $task){
        $task->delete();

        return redirect()->route('task.index')->with('successDestroy', 'Task deleted successfully');
    }

    public function incomplete(){
        $data = [
            'tasks' => Task::where('status', 'incomplete')->latest()->get(),
        ];

        return view('incomplete', $data);
    }
    
    public function completed(){
        $data = [
            'tasks' => Task::where('status', 'completed')->latest()->get(),
        ];

        return view('completed', $data);
    }

    public function status(Task $task){
        if($task->status == 'completed'){
            $task->update([
                'status' => 'incomplete',
            ]);
        }else{
            $task->update([
                'status' => 'completed',
            ]);
        }

        return redirect()->route('task.index')->with('successStatus', 'Task status changed successfully');
    }
}
