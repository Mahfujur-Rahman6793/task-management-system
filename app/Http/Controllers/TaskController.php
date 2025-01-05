<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        return view('tasks.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status = 0;
        $task->save();
        // return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
        return response()->json(['success' => 'Task created successfully!']);
    }
    public function taskManagement(Request $request)
    {
        // dd($request->all());
        $task = Task::findOrFail($request->id);
        // dd($task);
        if ($task->status == 0) {

            $task->status = 1;
        } else {
            $task->status = 0;
        }
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
    }

    public function update($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }


    public function updatePost(Request $request, Task $task)
    {
        // dd($request->all());
        // if ($task->user_id !== Auth::id()) {
        //     abort(403);
        // }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // $task->update($request->all());
        $task = Task::findOrFail($request->id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->save();


        // return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        return response()->json(['success' => 'Task updated successfully.']);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
