<?php

namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;
/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getPaginateUser(Request $request);
}
