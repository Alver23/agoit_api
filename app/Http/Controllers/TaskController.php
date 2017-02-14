<?php

namespace App\Http\Controllers;

use App\Priorities;
use App\Task;
use App\User;
use Validator;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use WithoutMiddleware;

    public function index()
    {
        $allTask = Task::all();
        if ($allTask)
        {
            return response()->json($allTask);
        }
        else
        {
            return response()->json(['error'=>'Nothing to list']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate fields
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'due_date' => 'required',
            'priority_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['warning'=> $validator->errors()]);
        }
        else
        {
            $newTask= new Task();
            $newTask->title = $request->input('title');
            $newTask->description = $request->input('description');
            $newTask->due_date = $request->input('due_date');
            //Put Priority
            $priority = Priorities::find($request->input('priority_id'));
            if ($priority)
            {
                $newTask->priority()->associate($priority);
            }

            $newTask->save();
            // OK
            return response()->json(['ok'=>'Successfully created Task']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the object
        $findPriority = Task::find($id);

        if($findPriority)
        {
            return response()->json(['ok'=>'Successfully find Priority '. $id]);
        }
        else
        {
            return response()->json(['error'=>'We cant find Priority '. $id]);
        }
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
        // validate fields
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'due_date' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['warning'=> $validator->errors()]);
        }
        else
        {
            $newTask = Task::find($id);
            $newTask->title = $request->input('title');
            $newTask->description = $request->input('description');
            $newTask->due_date = $request->input('due_date');
            //Put Priority
            $priority = Priorities::find($request->input('priority_id'));
            if ($priority)
            {
                $newTask->priority()->associate($priority);
            }

            $newTask->save();
            // OK
            return response()->json(['ok'=>'Successfully updated Task '. $id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // get the object
        $task = Task::find($id);

        if($task)
        {
            $task->delete();
            return response()->json(['ok'=>'Successfully deleted Task '. $id]);
        }
        else
        {
            return response()->json(['error'=>'We cant find Task '. $id]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function assing_task_to_user(Request $request)
    {
        $task = Task::find($request->input('task_id'));
        $user_list  = $_POST['user_id'];

        foreach ($user_list as $iterator)
        {
            $user = User::find($iterator);
            if($task && $user_list)
            {
                $user->tasks()->attach($task);
            }
        }
        return response()->json(['ok'=>'The task was assigned']);
    }
}
