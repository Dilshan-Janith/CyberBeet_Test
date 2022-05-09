<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::latest()->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task_name' => 'required',
            'task_start' => 'required',
            'task_due' => 'required|after:task_start',
        ]);

        Task::create([
            'task_name' => $request['task_name'],
            'task_start' => $request['task_start'],
            'task_due' => $request['task_due'],
            'task_status' => 0,
        ]);

        return Task::latest()->paginate(20);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::FindOrFail($id);

        if ($task->task_status == 1 && $request->task_status == 0) {
            if ($request->task_start <= $task->task_start && $request->task_due <= $task->task_due) {
                return response()->json(['status' => 500, 'error' => 'You have to update Task Start date and Due date.!']);
            }
        }

        $this->validate($request, [
            'task_start' => 'required',
            'task_due' => 'required|after:task_start',
        ]);

        $task->task_name = $request->task_name;
        $task->task_start = $request->task_start;
        $task->task_due = $request->task_due;
        $task->task_status = $request->task_status;
        $task->task_done = $request->task_status == 1 ? date('Y-m-d') : null;
        $task->save();

        return Task::latest()->paginate(20);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        
        return Task::latest()->paginate(20);
    }
}
