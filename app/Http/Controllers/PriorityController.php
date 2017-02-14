<?php

namespace App\Http\Controllers;

use App\Priorities;
use Validator;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    use WithoutMiddleware;

    public function index()
    {
        $allPriorities = Priorities::all();
        if ($allPriorities)
        {
            return response()->json($allPriorities);
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
            'name' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['warning'=> $validator->errors()]);
        }
        else
        {
            $newPriority = new Priorities();
            $newPriority->name = $request->input('name');
            $newPriority->save();
            // OK
            return response()->json(['ok'=>'Successfully created Priority']);
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
        $findPriority = Priorities::find($id);

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
            'name' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['warning'=> $validator->errors()]);
        }
        else
        {
            $newPriority = Priorities::find($id);
            $newPriority->name = $request->input('name');
            $newPriority->save();

            // OK
            return response()->json(['ok'=>'Successfully updated Priority '. $id]);
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
        $priority = Priorities::find($id);

        if($priority)
        {
            $priority->delete();
            return response()->json(['ok'=>'Successfully deleted Priority '. $id]);
        }
        else
        {
            return response()->json(['error'=>'We cant find Priority '. $id]);
        }
    }
}
