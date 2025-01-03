<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    public function __construct()
    {

    }
    public function paginate(Request $request)
    {
        $config = config('apps.user');
        $perPage = $request->get('per_page', 20);
        $query = User::where('role', '!=', 'admin');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->get('search') != '') {
            $search = $request->get('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Phân trang và trả về dữ liệu
        $users = $query->paginate($perPage);

        return [
            'users' => $users,
            'config' => $config,
        ];
    }
}
