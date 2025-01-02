<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $config =  config('apps.user');
        $perPage = $request->get('per_page', 20);
        $query = User::where('role', '!=', 'admin');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->get('search') != '') {
            $search = $request->get('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $users = $query->paginate($perPage);

        return view('users.index', compact('users', 'config'));
    }

    public function create()
    {
        $title = 'Thêm mới thành viên';
        return view('users.create', compact( 'title'));
    }


    public function store(CreateUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);


        return redirect()->route('users.index')->with('success', 'Người dùng đã được thêm thành công.');
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
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa thành công!');
    }

    public function bulkDelete(Request $request)
    {
        $userIds = $request->input('user_ids');
        if ($userIds) {
            User::destroy($userIds);
            return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa thành công!');
        }

        return redirect()->route('users.index')->with('error', 'Chưa chọn người dùng nào để xóa.');
    }

}
