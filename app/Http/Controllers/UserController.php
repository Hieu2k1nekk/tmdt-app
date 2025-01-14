<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class UserController extends Controller
{
    protected $userService;
    protected $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }
    public function index(Request $request)
    {
        $data = $this->userService->paginate($request);

        return view('users.index', [
            'users' => $data['users'],
            'config' => $data['config'],
        ]);
    }

    public function create()
    {
        $title = 'Thêm mới thành viên';
        $config = config('apps.user');
        return view('users.create', compact( 'title', 'config'));
    }


    public function store(CreateUserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        $this->userRepository->create($data);

        return redirect()->route('users.index')->with('success', 'Người dùng đã được thêm thành công.');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $config = config('apps.user');
        $user = $this->userRepository->find($id);
        return view('users.edit', compact('user', 'config'));
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];
        $this->userRepository->update($id, $data);
        return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công!');
    }


    public function destroy($id)
    {
        $this->userRepository->delete($id);
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
