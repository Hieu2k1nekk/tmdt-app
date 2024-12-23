<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Quản lý thành viên';
//        $users = User::where('role', '!=', 'admin')->get();
        $users = User::all();
        return view('users.index', compact('users', 'title'));
    }

    public function create()
    {
        //
    }


    public function store()
    {
        //
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $title = 'Chỉnh sửa thành viên';
        $user = User::findOrFail($id);
        return view('users.edit', compact('user','title'));
    }


    public function update(UpdateUserRequest $request, $id)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công!');
    }


    public function destroy($id)
    {
        //
    }

}
