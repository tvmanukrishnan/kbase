<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\User;
use Spatie\Permission\Models\Role;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        $roles = Role::all();
        $users = User::all();
        return view('user.user_list', compact('states', 'roles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        $roles = Role::all();
        return view('user.user_registration', compact('states', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'phone_no' => 'required|digits_between:10,15',
            'address' => 'required',
            'state' => 'required|exists:states,id',
            'district' => 'required|exists:districts,id',
            'area' => 'required|exists:areas,id',
            'role' => 'required|integer|exists:roles,id',
            'gender' => 'string|nullable|size:1',
            'age' => 'integer|nullable|digits_between:0,150',
            'lat' => 'string|nullable|max:10|required_with:long',
            'long' => 'string|nullable|max:10|required_with:lat'
        ]);
        if ($v->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->with('status', 'warning')
                    ->with('message', $v->errors());
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->address = $request->address;
        $user->phone_no = $request->phone_no;
        $user->address = $request->address;
        $user->state_id = $request->state;
        $user->district_id = $request->district;
        $user->area_id = $request->area;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->co_ordinates = $request->lat . ',' . $request->long;
        $user->verified = true;

        if ($user->save()) {
            $status = 1;
            // $user->roles()->attach($request->role_id);
        }
        if ($status) {
            return redirect()->route('user.list')
                ->with('status', 'success')
                ->with('message', 'User added succesfully');
        }
        return redirect()->back()
            ->withInput()
            ->with('status', 'danger')
            ->with('message', 'Failed adding User');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activate($id)
    {
        //
    }
}
