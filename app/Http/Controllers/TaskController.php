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
        return response()->json(['success' => 'Task created successfully.']);
    }
    public function taskManagement(Request $request)
    {
        // dd($request->all());
        $task = Task::find($request->id);
        // dd($task);
        if ($task->status == 0) {

            $task->status = 1;
        } else {
            $task->status = 0;
        }
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());
        return response()->json(['success' => 'Task updated successfully.']);
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return response()->json(['success' => 'Task deleted successfully.']);
    }

    public function toggleStatus(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update(['status' => $task->status === 'pending' ? 'completed' : 'pending']);
        return response()->json(['success' => 'Task status updated.']);
    }
}
