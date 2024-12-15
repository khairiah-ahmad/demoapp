<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userId = Auth::user()->id;
        $tasks = Task::where(['user_id' => $userId])->get();
        return view('task.list', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('task.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userId = Auth::user()->id;
        $input = $request->input();
        $input['user_id'] = $userId;
        $taskStatus = Task::create($input);

        if ($taskStatus) {
            $message = 'Task successfully added';
            $type = 'success';
        } else {
            $message = 'Oops, something went wrong. Task not saved';
            $type = 'error';
        }

        return redirect('task')->with($type, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $userId = Auth::user()->id;
        $task = Task::where(['user_id' => $userId, 'id' => $id])->first();
        if (!$task) {
            return redirect('task')->with('error', 'Task not found');
        }
        return view('task.view', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $userId = Auth::user()->id;
        $task = Task::where(['user_id' => $userId, 'id' => $id])->first();
        if ($task) {
            return view('task.edit', ['task' => $task]);
        } else {
            return redirect('task')->with('error', 'Task not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $userId = Auth::user()->id;
        $task = Task::find($id);
        if (!$task) {
            return redirect('task')->with('error', 'Task not found.');
        }
        $input = $request->input();
        $input['user_id'] = $userId;
        $taskStatus = $task->update($input);
        if ($taskStatus) {
            return redirect('task')->with('success', 'Task successfully updated.');
        } else {
            return redirect('task')->with('error', 'Oops something went wrong. Task not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $userId = Auth::user()->id;
        $task = Task::where(['user_id' => $userId, 'id' => $id])->first();
        $respStatus = $respMsg = '';
        if (!$task) {
            $respStatus = 'error';
            $respMsg = 'Task not found';
        }
        $taskDelStatus = $task->delete();
        if ($taskDelStatus) {
            $respStatus = 'success';
            $respMsg = 'Task deleted successfully';
        } else {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. Task not deleted successfully';
        }
        return redirect('task')->with($respStatus, $respMsg);
    }

}
