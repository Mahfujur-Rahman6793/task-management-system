<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateValidationRequest;
use App\Http\Requests\validationRequest;
use App\Models\Task;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TaskManagementController extends ApiController implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Task::get();
        if (!$task) {
            return $this->errorResponse("Task not Fond");
        }
        return $this->successResponse($task);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(validationRequest $request)
    {

        // $task = TaskManagement::create($request->validated());
        $task = $request->user()->tasks()->create($request->validated());

        // dd($task);

        return $this->successResponse($task, "Added new Task", 200);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->errorResponse("Task not Fond");
        }
        return $this->successResponse($task);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateValidationRequest $request, $id)
    {
        $task = Task::find($id);
        $task->update($request->validated());
        if (!$task) {
            return $this->errorResponse("Task not Fond");
        }
        return $this->successResponse($task, "Updated Task Successfully", 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->errorResponse("Task not Fond");
        }
        $task->delete();

        return $this->successResponse(null, "Deleted Task Successfully", 200);
    }
}
