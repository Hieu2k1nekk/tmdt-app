<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function paginate(Request $request)
    {
        $result = $this->userRepository->getPaginateUser($request);

        return [
            'users' => $result['users'],
            'config' => $result['config'],
        ];
    }

    public  function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1)?2:1);
            $user = $this->userRepository->update($post['modeId'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            return false;
        }
    }
}
