<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
    public function getPaginateUser(Request $request)
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
