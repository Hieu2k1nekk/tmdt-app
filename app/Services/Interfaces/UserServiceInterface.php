<?php

namespace App\Services\Interfaces;
use Illuminate\Http\Request;
/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserServiceInterface
{
    public function paginate(Request $request);
    public  function updateStatus($post = []);

}
