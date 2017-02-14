<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use WithoutMiddleware;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUser = User::all();
        if ($allUser)
        {
            return response()->json($allUser);
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['warning'=> $validator->errors()]);
        }
        else
        {
            $newUser = new User();
            $newUser->firstname = $request->input('firstname');
            $newUser->lastname = $request->input('lastname');
            $newUser->email = $request->input('email');
            $newUser->password = $request->input('password');
            $newUser->save();
            // OK
            return response()->json(['ok'=>'Successfully created User']);
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
        $findUser = User::find($id);

        if($findUser)
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['warning'=> $validator->errors()]);
        }
        else
        {
            $newUser = User::find($id);
            $newUser->firstname = $request->input('firstname');
            $newUser->lastname = $request->input('lastname');
            $newUser->email = $request->input('email');
            $newUser->password = $request->input('password');
            $newUser->save();

            // OK
            return response()->json(['ok'=>'Successfully updated User '. $id]);
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
        $user = User::find($id);

        if($user)
        {
            $user->delete();
            return response()->json(['ok'=>'Successfully deleted user '. $id]);
        }
        else
        {
            return response()->json(['error'=>'We cant find User '. $id]);
        }
    }
}
